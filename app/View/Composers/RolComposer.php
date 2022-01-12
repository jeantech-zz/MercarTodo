<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RolComposer
{
    public function compose(View $view): void
    {
        $view->with(
            'roles',
            DB::table('roles')->select('name')->orderBy('name')->get(),
        );
    }
}
