<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\PaymentGateways\PaymentGatewayContract;
use App\PaymentGateways\Placetopay;

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

    
    public function boot(): void
    {
        $this->app->bind(PaymentGatewayContract::class, Placetopay::class);
    }
}
