<?php

namespace App\Actions\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UpdateActions
{
    public static function execute(array $data): User
    {
      
        $record = User::find($data['id']);
        if($data['password']=='' or $data['password']==null ){
            $password = $record->password;
        }else{
            $password = Hash::make($data['password']);
        }
        $record->update([ 
            'name' =>  $data['name'],
            'email' => $data['email'] ,
            'password' => $password,
            'phone_number' => $data['phone_number'] ,
            'address' => $data['address']
        ]);

        return $record;
    }
}