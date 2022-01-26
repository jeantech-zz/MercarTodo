<?php

namespace Tests\Feature\Order;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderPayTest extends TestCase
{
    use RefreshDatabase;
    public const CURRENCIES_ROUTE_NAME = 'orders.destroy';

    
    public function test_order_pay_screen_can_be_rendered(): void
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
        $response = $this->actingAs($user)->GET(route('orders.showPay', $order));
        $response->assertStatus(200);
       
    }

    public function test_order_pay_can_be(): void
    {
        
        $users = User::factory(5)->create();
        $user = User::factory()->create();
        $order = Order::factory()->create([
            'user_id' => $user->id
        ]            
        );
        $product = Product::factory()->create([
            'price' => 20000
        ]);
        $orderProduct = OrderProduct::factory()->create(
            [
                'product_id'=> $product->id,
                'order_id' =>  $order->id
            ]
        );

        
        $response = $this->actingAs($user)->put(route('orders.orderPay', $order));
    
      $response->assertRedirectContains('localhost');
        // $response->assertStatus(200);
       // $response->assertRedirect(route('orders.showPay', $order));
       
    }
}
