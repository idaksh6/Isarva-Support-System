<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


use App\Models\Backend\Client;
use Illuminate\Support\Facades\Auth;
/**
 * Class AppServiceProvider.
 */
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
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();


          // Share client status with all views
        // view()->composer('*', function ($view) {
        //     $user = Auth::user();
        //     $isClient = false;

        //     if ($user) {
        //         $isClient = Client::where('user_name', $user->user_name)->exists();
        //     }

        //     $view->with('isClient', $isClient);
        // });
    }
}
