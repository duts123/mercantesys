<?php

namespace App\Providers;

use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
\Braintree_Configuration::environment("sandbox");
\Braintree_Configuration::merchantId("wq53b69j3b2gjmcv");
\Braintree_Configuration::publicKey("rgcr6yk8xd4szv74");
\Braintree_Configuration::privateKey("1dbe8598df54bb46cbb3e87f77a581a7");

      // 	Request::setTrustedProxies(['54.167.249.158']); // Here should be your internal LB IP

     //	parent::boot();
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
