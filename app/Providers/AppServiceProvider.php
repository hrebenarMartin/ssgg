<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.app', function (){
           $logged_user = Auth::id();
           $user = User::getUserById($logged_user);

           $admin_menu_items = DB::table('admin_menu')->get();

           //dd($logged_user);
           //dd($admin_menu_items);

           view()->share('menu_items', $admin_menu_items);
           view()->share('user', $user);

        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
