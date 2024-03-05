<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::defaultStringLength(191);
        Paginator::useBootstrap();


        view()->composer('*', function ($view) {
            $userAuthenticated = Auth::user();
            $view->with('userAuthenticated', $userAuthenticated);
        });
    }
}
