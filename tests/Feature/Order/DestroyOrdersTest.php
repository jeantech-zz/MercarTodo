<?php

namespace Tests\Feature\Order;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DestroyOrdersTest extends TestCase
{
    use RefreshDatabase;
    public const CURRENCIES_ROUTE_NAME = 'orders.destroy';

    
    public function test_order_destroy_screen_can_be_rendered(): void
    {
        
        $users = User::factory(5)->create();
        $user = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user->id
        ]            
        );
        $product = Product::factory()->create();
        $orderProduct = OrderProduct::factory()->create(
            [
                'product_id'=> $product->id,
                'order_id' =>  $order->id
            ]
        );
   
        $response = $this->actingAs($user)->DELETE(route('orders.destroy', $order));
        $response->assertRedirect(route('orders.index'));
       
    }
}
