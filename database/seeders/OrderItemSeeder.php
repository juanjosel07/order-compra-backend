<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
		$orders = Order::all();

		foreach ($orders as $order) {
			$items = 3;

			for ($i = 0; $i < $items; $i++) {
				$product = $products->random();

				$order->orderItems()->create([
					'product_id' => $product->id,
					'quantity' => 2,
					'unit_price' => $product->unit_price,
					'iva' => $product->iva,
					'subtotal' => $product->unit_price * 2,
					'total' => $product->unit_price * 2 + (($product->unit_price * 2) * ($product->iva / 100)),
				]);
			}
		}
    }
}
