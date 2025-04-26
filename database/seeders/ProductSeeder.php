<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creando seeders para llenar products de la BD

		Product::create([
			'name' => 'Computador',
			'unit_price' => 1000000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Monitor',
			'unit_price' => 750000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Teclado',
			'unit_price' => 200000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Mouse',
			'unit_price' => 50000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Parlantes',
			'unit_price' => 800000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Impresora',
			'unit_price' => 300000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Altavoces',
			'unit_price' => 150000,
			'iva' => 10
		]);

		Product::create([
			'name' => 'Webcam',
			'unit_price' => 100000,
			'iva' => 10
		]);
		Product::create([
			'name' => 'Reloj de pulsera',
			'unit_price' => 600000,
			'iva' => 10
		]);
		Product::factory(10)->create();

    }
}
