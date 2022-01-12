<?php

namespace App\Providers;

use App\View\Composers\RolComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('users.index', RolComposer::class);
    }
}
