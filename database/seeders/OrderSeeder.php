<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Order::create([
			'client_name' => 'Cliente 1',
			'payment_method' => 'Efectivo',
			'total' => 10000000,
			'discount' => 0,
			'observations' => 'Sin observaciones',
			'order_date' => now(),
		]);
    }
}
