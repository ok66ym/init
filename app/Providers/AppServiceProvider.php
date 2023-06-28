<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        \URL::forceScheme('https'); //追記
        $this->app['request']->server->set('HTTPS', 'on'); //pagination対応
         Paginator::useBootstrap();  //動画参照
        
        //Paginator::useBootstrapFive());   //公式ドキュメント参照
        //Paginator::useBootstrapFour());   //公式ドキュメント参照
    }
}
