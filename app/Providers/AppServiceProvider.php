<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
            View::composer('*', function ($view) {
                $cartCount = \App\Models\Cart::count(); // or ->where('client_name', 'Client')->count()
                $view->with('cartCount', $cartCount);
            });
    }
}
