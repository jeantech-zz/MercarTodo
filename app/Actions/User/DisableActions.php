<?php

namespace App\Actions\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class DisableActions
{
    public static function execute(User $user)
    {
       
        $record= $user->update([ 
            'disabled_at' =>  now()
        ]);

        return $record;
    }
}