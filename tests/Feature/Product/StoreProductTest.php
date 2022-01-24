<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
    }

    /**
     * @dataProvider productProvider
     */
    public function test_new_product_can_create(string $name, string  $description, string  $price, string  $image): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/products', compact('name', 'description', 'price', 'image'));

        $this->assertDatabaseHas('products',[
            'name' => 'jabon',
            'description' => 'jabon',  
            'price' => '2000',          
            'image' => "jabon.jpg"
        ]);  
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function test_it_validate_request_data_product(string $name, string  $description, string  $price, string  $image, string $field): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/products', compact('name', 'description', 'price', 'image'));

        $response->assertInvalid([$field]);
    }

    public function invalidDataProvider(): array
    {
        $data = $this->productProvider()['product'];
        
        return [
            'name required' => array_merge($data, ['name' => '', 'field' => 'name']),
            'name max' => array_merge($data, ['name' => Str::random(256), 'field' => 'name']),
            'description required' => array_merge($data, ['description' => '', 'field' => 'description']),            
            'description max' => array_merge($data, ['description' => Str::random(256), 'field' => 'description']),            
            'price required' => array_merge($data, ['price' => '', 'field' => 'price']),            
            'price max' => array_merge($data, ['price' => Str::random(256), 'field' => 'price']), 
            'image required' => array_merge($data, ['image' => '', 'field' => 'image']),            
            
        ];
    }

    public function productProvider(): array
    {
        return [
            "product" => [
                'name' => 'jabon',
                'description' => 'jabon',
                'price' => '2000',
                'image' => "jabon.jpg"
            ]
        ];
    }
}
