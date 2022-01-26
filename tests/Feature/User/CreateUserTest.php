<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_screen_can_be_rendered(): void
    {
        $rol = Role::factory()->create();
        $user = User::factory()->create([
            'rol_id' => $rol->id
        ]);
        $response = $this->actingAs($user)->get('/users');

        $response->assertStatus(200);
    }

    /**
     * @dataProvider userProvider
     */
    public function test_new_users_can_create(string $name, string  $email,string  $password, string  $password_confirmation, string $phone_number, string  $address ): void
    {
        $rol = Role::factory()->create();
        $user = User::factory()->create([
            'rol_id' => $rol->id
        ]);
        $response = $this->actingAs($user)->post('/users', compact('name','email','password', 'password_confirmation', 'phone_number', 'address'));
    
        $this->assertDatabaseHas('users',[
            'name' => 'Jennifer',
            'email' => 'jeante18@gmail.com',
            'phone_number' => '31243435',
            'address' => 'carrera 1 #1-1',
        ]);  
    }

    /**
     * @dataProvider invalidDataProvider
     */
    
    public function test_it_validate_request_data_user(string $name, string  $email,string  $password, string  $password_confirmation, string $phone_number, string  $address, string $field): void
    {
        $this->withoutExceptionHandling();
        $rol = Role::factory()->create();
        $user = User::factory()->create([
            'rol_id' => $rol->id
        ]);

        $response = $this->actingAs($user)->post('/users', compact('name','email','password', 'password_confirmation', 'phone_number', 'address'));

        $response->assertInvalid([$field]);
    }

     /**
     * @dataProvider userProvider
     */
    
    public function test_email_is_unique_user(string $name,string  $email,string  $password, string  $password_confirmation, string $phone_number, string  $address): void
    {
        $user= User::factory()->create(compact('name','email','password', 'phone_number', 'address'));
        $this->test_it_validate_request_data_user($name, $email, $password, $password_confirmation, $phone_number, $address, 'email');
    }


    public function invalidDataProvider(): array
    {
        $data = $this->userProvider()['user'];
        
        return [
            'name required' => array_merge($data, ['name' => '', 'field' => 'name']),
            'name max' => array_merge($data, ['name' => Str::random(256), 'field' => 'name']),
            'email required' => array_merge($data, ['email' => '', 'field' => 'email']),            
            'email max' => array_merge($data, ['email' => Str::random(255), 'field' => 'email']),            
            'password required' => array_merge($data, ['password' => '', 'field' => 'password']),            
            'password min' => array_merge($data, ['password' => 'jen', 'field' => 'password']), 
            'phone_number max' => array_merge($data, ['phone_number' => Str::random(256), 'field' => 'phone_number']),
            'address max' => array_merge($data, ['address' => Str::random(256), 'field' => 'address']),           
            
        ];
    }

    public function userProvider(): array
    {
        return [
            "user" => [
            'name' => 'Jennifer',
            'email' => 'jeante18@gmail.com',
            'password' =>'jeante18',
            'password_confirmation' => 'jeante18',
            'phone_number' => '31243435',
            'address' => 'carrera 1 #1-1',
            'rol_id' => 1            ]
        ];
    }
}
