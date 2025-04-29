<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function it_can_list_orders()
    {
        $response = $this->getJson('/api/orders');
        $response->assertStatus(200);
    }

	public function test_get_a_order_by_id_successfully()
    {
        $order = Order::factory()->create();
        $response = $this->getJson("/api/orders/{$order->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'success' => true,
        ]);

		$response->assertJsonStructure([
			'success',
			'order' =>[],
		]);
    }

	public function test_get_a_non_existing_order_return_404(): void
	{
    	$badId = 100000;

    	$response = $this->getJson("/api/orders/{$badId}");

    	$response->assertStatus(404);
    	$response->assertJson([
    	    'success' => false,
    	    'message' => 'Order no Encontrada',
    	]);
	}
}
