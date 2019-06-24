<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        Schema::defaultStringLength(250);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //通过视图合成器将信息分配到公共模板
        \View::composer('layout.sidebar', function($view){

            //1.获取所有的Topic专题数据
            $topics = \App\Topic::all();

            //2.分配到视图模板
            $view->with('topics', $topics);

        });
    }
}
