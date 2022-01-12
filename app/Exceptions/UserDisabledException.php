<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserDisabledException extends Exception
{
    private Request $request; 

    public function __contruct(Request $request , string $message = "", int $code = 0, ?Throwable $previus = null){
        parent::_construct($message, $code, $previous);
        $this->request = $request;
    }

   public function render(): RedirectResponse
   {
       return redirect()->route('login')->onlyInput('email')->with('disabled', trans('auth.user_blocked'));
   }

   public function contex(): array
   {
        return ['email' => $this->request->input('email'), 'ip' => $this->request->ip()];
   }
}
