<?php

namespace App\Providers;

use App\Models\Conference;
use App\Models\ConferenceConfiguration;
use App\Models\Contribution;
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

            if(session()->has('module')) $module = session()->pull('module');
            else $module = 1;

            $front_menu = FrontMenu::where('module', $module)->where('active', 1)->orderBy('rank', 'ASC')->get();
            $conference = Conference::where('status', 1)->first();

            view()->share('menu_items', $front_menu);
            view()->share('user', $user);
            view()->share('module', $module);

            //Ak je otvorená konferencia, vložíme do view všetky potrebné dáta
            if($conference){
                view()->share('conference', $conference);
            }

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
