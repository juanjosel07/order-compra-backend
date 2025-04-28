<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
	{
		$products = Product::all();
		return response()->json($products, 200);
	}
}
