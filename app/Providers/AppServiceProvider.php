<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.login', function($view){
          $userId = Auth::user()->id;
          $count_followings = \DB::connection('dawnSNS')
            ->table('follows')
            ->where('user_id', '=', $userId)
            ->count();

          $view->with('count_followings',$count_followings);
        });

        View::composer('layouts.login', function($view){
          $userId = Auth::user()->id;
          $count_followers = \DB::connection('dawnSNS')
            ->table('follows')
            ->select('follow_id')
            ->where('follow_id', '=', $userId)
            ->count();

          $view->with('count_followers',$count_followers);
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
