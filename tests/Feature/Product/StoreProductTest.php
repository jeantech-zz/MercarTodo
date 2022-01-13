<?php

namespace Tests\Feature\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;
    use WithhFaker;

    public function test_product_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);
    }

    public function test_it_store_a_product()
    {
        $data = [
            'name'  => $this->faker->text(88),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomNumber,
            'quantity' => $this->faker->randomNumber,
        ];

        $response = $this->post('/admin/products', $data);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('products', $data);
    }
}
