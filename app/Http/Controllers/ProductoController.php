<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
	/**
 * @OA\Get(
 *     path="/api/products",
 *     summary="Obtener todos los productos",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="Listado de productos",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Computador"),
 *                 @OA\Property(property="unit_price", type="number", format="float", example=2000000.00),
 *                 @OA\Property(property="iva", type="number", format="float", example=10.00)
 *             ),
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="name", type="string", example="Monitor LED 24'"),
 *                 @OA\Property(property="unit_price", type="number", format="float", example=500000.00),
 *                 @OA\Property(property="iva", type="number", format="float", example=12.00)
 *             ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error en el servidor",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Internal Server Error")
 *         )
 *     )
 * )
 */

    public function index()
	{
		$products = Product::all();
		return response()->json($products, 200);
	}
}
