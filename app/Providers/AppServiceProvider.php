<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Users;
use App\Member;
use App\Cow;
use App\News;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $communitys = Users::all();
            $members = Member::all();
            $cows = Cow::all();
            $news_list = News::all(); 
            $view->with(['communitys' => $communitys,'members'=>$members,'cows'=>$cows,'news_list'=>$news_list]);
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
