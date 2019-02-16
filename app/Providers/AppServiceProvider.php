<?php

namespace App\Providers;

use App\Models\Conference;
use App\Models\FrontMenu;
use App\Models\Profile;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
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
            $user = User::find($logged_user);
            if($user) $user->profile = Profile::where('user_id', $user->id)->first();

            $front_menu = FrontMenu::orderBy('rank', 'ASC')->get();
            $conference = Conference::where('status', 1)->first();

            if($conference) $conference->is = 1;
            else $conference->is = 0;

            view()->share('menu_items', $front_menu);
            view()->share('user', $user);
            view()->share('conference', $conference);

        });

        view()->composer('backend.layouts.app', function (){
            $user_data = Profile::where('user_id', Auth::id())->first();
            view()->share('user_data', $user_data);
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
