<?php

namespace App\Actions\Fortify;

use App\Exceptions\UserDisabledException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;


class AuthenticateUser  
{
    /**
     * @throws \Throwoble
     */
    // ValidationException
    public function authenticates(Request $request): ?User
    {
        $user = User::where('email', $request->input('email'))->first();
        
        if(null === $user || false ===  Hash::check($request->input('password'), $user->password())){
            return null;
        }

        throw_if($user->isDisabled(), UserDisabledException::class, $request);

        /*if($user->isDisabled()){
            throw ValidationException::withMessages([
                Fortify::username() => [trans('auth.user_blocked')],
            ]);
        }
        
        if(false === Has::check($request->input('password'), $user->password())){
            return null;
        }*/

        return $user;
    }

    
}