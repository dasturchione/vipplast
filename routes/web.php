<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\YoutubeController;
use App\Http\Controllers\Client\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactPost'])->name('contact');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/products', [HomeController::class, 'all'])->name('products.all');
Route::get('/products/{categorySlug}/{subcategorySlug?}', [HomeController::class, 'products'])->name('products');
Route::get('/slugp', [HomeController::class, 'slugg']);
Route::get('product/{productSlug}', [HomeController::class, 'product'])->name('product.show');

Route::get('lang/{locale}', function ($locale) {
    session(['language' => $locale]);
    return back();
});

Route::prefix('admin')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('admin.dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/banners', [BannerController::class, 'index'])->name('admin.banners');
        Route::get('/banner/{action}/{id?}', [BannerController::class, 'form'])->name('admin.banners.form');
        Route::post('/banner/{id?}', [BannerController::class, 'post'])->name('admin.banners.post');
        Route::delete('/banner/{id}', [BannerController::class, 'destroy'])->name('admin.banner.destroy');

        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::post('/category/{id?}', [CategoryController::class, 'post'])->name('admin.category.post');
        Route::delete('/category/{id?}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::post('/child-categories/{parentid}', [CategoryController::class, 'childCategory']);
        Route::post('/categories/update', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::get('/youtubeblogs', [YoutubeController::class, 'index'])->name('admin.ytblog');
        Route::get('/youtubeblog/{action}/{id?}', [YoutubeController::class, 'form'])->name('admin.ytblog.form');
        Route::post('/youtubeblog/{id?}', [YoutubeController::class, 'post'])->name('admin.ytblog.post');
        Route::delete('/youtubeblog/{id?}', [YoutubeController::class, 'destroy'])->name('admin.ytblog.destroy');

        Route::get('/catalogs', [CatalogController::class, 'index'])->name('admin.catalogs');
        Route::post('/catalog/post', [CatalogController::class, 'post'])->name('admin.catalog.post');
        Route::post('/catalog/sort', [CatalogController::class, 'sort'])->name('catalog.sort');
        Route::delete('/catalog/{id?}', [CatalogController::class, 'destroy'])->name('admin.catalog.destroy');

        Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
        Route::get('/product/{action}/{id?}', [ProductController::class, 'form'])->name('admin.products.form');
        Route::post('/product/{id?}', [ProductController::class, 'post'])->name('admin.products.post');
        Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::post('/user/{id?}', [UserController::class, 'post'])->name('admin.user.post');

        Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('admin.feedbacks');
        Route::post('/feedback/view', [FeedbackController::class, 'markAsRead'])->name('admin.feedback.view');

        Route::get('/settings', [SettingController::class, 'form'])->name('admin.settings');
        Route::post('/settingsp', [SettingController::class, 'post'])->name('admin.setting.post');

    });

    // default /admin kirganda redirect qilish
    Route::get('/', function () {
        return auth()->guard()->check()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('login');
    });
});
