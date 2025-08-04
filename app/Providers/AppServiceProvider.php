<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\SettingResource;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $lang = App::currentLocale();
        $company = new SettingResource(Setting::first());

        $transformedCompany = $company->toArray(request());
        if (Request::is('admin/*')) {
            view()->composer('admin.*', function ($view) {
                if (!Auth::guest()) {
                    $view->with('user', Auth::user());
                }
            });
        }
        view()->composer('*', function ($view) use ($transformedCompany, $lang) {
            $view->with('company', $transformedCompany);
            $view->with('lang', $lang);
        });
    }
}
