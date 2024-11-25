<?php

namespace App\Providers;

use App\Http\View\Composers\CategoriesViewComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('*', CategoriesViewComposer::class);
        Paginator::useBootstrap();
    }
}
