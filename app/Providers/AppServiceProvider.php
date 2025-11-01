<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

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
        // Fix untuk MySQL versi lama (InfinityFree)
        Schema::defaultStringLength(191);
        
        // Share settings dengan semua view (lazy load untuk hindari database query di boot)
        View::composer('*', function ($view) {
            if (!$view->offsetExists('siteSettings')) {
                $view->with('siteSettings', Setting::allAsArray());
            }
        });
    }
}
