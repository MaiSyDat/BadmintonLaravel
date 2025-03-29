<?php

namespace App\Providers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('Frontend.Layout.nav', function ($view) {
            $categories = Categories::all();
            $view->with(compact('categories'));
        });
    }
}
