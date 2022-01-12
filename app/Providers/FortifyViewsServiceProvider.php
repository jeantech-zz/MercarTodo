<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyViewsServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Fortify::loginView(fn () => view('auth.login'));
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::verifyEmailView(fn () => view('auth.verify-email'));
        /*Fortify::registerView(fn () => view('auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('auth.passwords.email'));
        Fortify::resetPasswordView(fn () => view('auth.passwords.reset',['request'=>$request]));    
        Fortify::verifyEmailView(fn () => view('auth.verify-email'));*/
   
    }
}
