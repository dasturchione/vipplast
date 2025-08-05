<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\Setting;
use App\Models\YoutubeBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $banners = BannerResource::collection(Banner::where('status', 1)->get());
        $shorts = YoutubeBlog::orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            $categories = Category::where('parent_id', null)->paginate(10);
            return view('client.partials.categories-swiper', compact('categories'))->render(); // Faqat itemlar bo‘lagi
        }
        $categories = Category::where('parent_id', null)->paginate(10);
        return view('client.pages.home', compact('banners', 'shorts', 'categories'));
    }

    public function contact()
    {
        return view('client.pages.contact');
    }

    public function contactPost(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^\+998\d{9}$/',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);


        // Handle the validated data (e.g., send an email, save to the database, etc.)

        Feedback::create($validated);

        return redirect()->back()->with('success', __('lang.message_sent'));
    }

    public function catalog()
    {
        $catalog = [
            (object)['image' => '1.jpg'],
            (object)['image' => '2.jpg'],
            (object)['image' => '3.jpg'],
            (object)['image' => '4.jpg'],
            (object)['image' => '5.jpg'],
            (object)['image' => '6.jpg'],
            (object)['image' => '7.jpg'],
            (object)['image' => '8.jpg'],
            (object)['image' => '9.jpg'],
            (object)['image' => '10.jpg'],
            (object)['image' => '11.jpg'],
            (object)['image' => '12.jpg'],
            (object)['image' => '13.jpg'],
            (object)['image' => '14.jpg'],
            (object)['image' => '15.jpg'],
            (object)['image' => '16.jpg'],
            (object)['image' => '17.jpg'],
        ];

        $breadcrumb = [
            ['label' => __('lang.catalog'), 'href' => route('catalog')],

        ];

        return view('client.pages.catalog', compact('catalog', 'breadcrumb'));
    }

    public function all(Request $request)
    {
        $products = Product::where('status', 1)->paginate(12);

        $breadcrumb = [
            ['label' => __('lang.products'), 'href' => route('products.all')],
        ];
        $type = 'all';
        if ($request->ajax()) {
            return view('client.partials.product-grid', compact('products'))->render();
        }

        return view('client.pages.product', compact('products', 'breadcrumb', 'type'));
    }

    public function products(Request $request, $categorySlug, $subcategorySlug = null)
    {
        $subcategories = [];

        $category = Category::where('slug', $categorySlug)->firstOrFail();

        if ($subcategorySlug) {
            $type = 'subcategory';
            $subcategory = Category::where('slug', $subcategorySlug)
                ->where('parent_id', $category->id)
                ->firstOrFail();

            $products = $subcategory->products()
                ->where('status', 1)
                ->paginate(12);

            $subcategories = $category->subcategories;

            $breadcrumb = [
                ['label' => __('lang.category'), 'href' => route('home')],
                ['label' => $category->{'name_' . app()->getLocale()}, 'href' => route('products', $category->slug)],
                ['label' => $subcategory->{'name_' . app()->getLocale()}, 'href' => route('products', [$category->slug, $subcategory->slug])],
            ];
        } else {
            $type = 'category';
            $categoryIds = $category->subcategories()->pluck('id')->toArray();
            $categoryIds[] = $category->id;

            $products = Product::whereIn('category_id', $categoryIds)
                ->where('status', 1)
                ->paginate(12);

            $subcategories = $category->subcategories;

            $breadcrumb = [
                ['label' => __('lang.category'), 'href' => route('home')],
                ['label' => $category->{'name_' . app()->getLocale()}, 'href' => route('products', $category->slug)],
            ];
        }

        if ($request->ajax()) {
            return view('client.partials.product-grid', compact('products'))->render();
        }

        return view('client.pages.product', compact('products', 'breadcrumb', 'subcategories', 'type'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('client.pages.productshow', compact('product'));
    }

    public function slugg()
    {
        Product::whereNull('slug')->chunk(200, function ($products) {
            foreach ($products as $product) {
                $product->generateSlug();
                $product->save();
            }
        });
    }

    public function about(){
        $about = Setting::first();
        return view('client.pages.about', compact('about'));
    }
}
