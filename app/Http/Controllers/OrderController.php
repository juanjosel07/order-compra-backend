<?php

namespace App\Http\Controllers;

use App\Dto\OrderDTO;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

/**
 * @OA\Info(
 *     title="Order Management API",
 *     version="1.0.0",
 *     description="API endpoints for managing orders"
 * )
 *

 */

class OrderController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/orders",
 *     summary="Listar todas las órdenes",
 *     description="Obtiene una lista de todas las órdenes registradas",
 *     operationId="getOrdersList",
 *     tags={"Orders"},
 *     @OA\Response(
 *         response=200,
 *         description="Lista de órdenes obtenida exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="client_name", type="string", example="Juan Pérez"),
 *                     @OA\Property(property="order_date", type="string", format="date", example="2025-04-29"),
 *                     @OA\Property(property="payment_method", type="string", example="Efectivo"),
 *                     @OA\Property(property="discount", type="number", format="float", example=10.00),
 *                     @OA\Property(property="total", type="number", format="float", example=1500.50),
 *                     @OA\Property(property="observations", type="string", example="Pedido urgente"),
 *                     @OA\Property(
 *                         property="order_items",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="product_id", type="integer", example=1),
 *                             @OA\Property(property="product_name", type="string", example="Producto A"),
 *                             @OA\Property(property="quantity", type="integer", example=2),
 *                             @OA\Property(property="unit_price", type="number", format="float", example=500.00),
 *                             @OA\Property(property="iva", type="number", format="float", example=80.00),
 *                             @OA\Property(property="subtotal", type="number", format="float", example=1000.00),
 *                             @OA\Property(property="total", type="number", format="float", example=1080.00)
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */

	public function index()
	{
		$orders = Order::query();
		return DataTables::of($orders)->toJson();
	}

	/**
 * @OA\Get(
 *     path="/api/orders/{id}",
 *     summary="Obtener los detalles de una orden específica",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la orden",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Detalles de la orden",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="order",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=2),
 *                 @OA\Property(property="client_name", type="string", example="Juan carreño"),
 *                 @OA\Property(property="order_date", type="string", format="date", example="2025-04-26"),
 *                 @OA\Property(property="payment_method", type="string", example="Tarjeta de crédito"),
 *                 @OA\Property(property="discount", type="string", example="10.00"),
 *                 @OA\Property(property="total", type="string", example="1000.00"),
 *                 @OA\Property(property="observations", type="string", example="Entrega urgente"),
 *                 @OA\Property(
 *                     property="order_items",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=5),
 *                         @OA\Property(property="order_id", type="integer", example=2),
 *                         @OA\Property(property="product_id", type="integer", example=1),
 *                         @OA\Property(property="quantity", type="integer", example=6),
 *                         @OA\Property(property="unit_price", type="string", example="100.00"),
 *                         @OA\Property(property="iva", type="string", example="21.00"),
 *                         @OA\Property(property="subtotal", type="string", example="200.00"),
 *                         @OA\Property(property="total", type="string", example="242.00"),
 *                         @OA\Property(property="product_name", type="string", example="Computador"),
 *                         @OA\Property(
 *                             property="product",
 *                             type="object",
 *                             @OA\Property(property="id", type="integer", example=1),
 *                             @OA\Property(property="name", type="string", example="Computador"),
 *                             @OA\Property(property="unit_price", type="string", example="1000000.00"),
 *                             @OA\Property(property="iva", type="string", example="10.00")
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Orden no encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Order no Encontrada")
 *         )
 *     )
 * )
 */


	public function show( Request $request)
	{
		$order = $request->get('order');
		$order->load('orderItems');
		return response()->json(['success' => true,'order' => $order],200);
	}

	/**
 * @OA\Post(
 *     path="/api/orders",
 *     summary="Crear una nueva orden con sus ítems",
 *     tags={"Orders"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"client_name", "order_date", "payment_method", "total", "orderItems"},
 *             @OA\Property(property="client_name", type="string", example="Juan León"),
 *             @OA\Property(property="order_date", type="string", format="date", example="2025-04-26"),
 *             @OA\Property(property="payment_method", type="string", example="Tarjeta de crédito"),
 *             @OA\Property(property="discount", type="number", format="float", example=10),
 *             @OA\Property(property="observations", type="string", example="Entrega urgente"),
 *             @OA\Property(property="total", type="number", format="float", example=1000),
 *             @OA\Property(
 *                 property="orderItems",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     required={"product_id", "quantity", "unit_price", "iva", "subtotal", "total"},
 *                     @OA\Property(property="product_id", type="integer", example=1),
 *                     @OA\Property(property="quantity", type="integer", example=2),
 *                     @OA\Property(property="unit_price", type="number", format="float", example=100),
 *                     @OA\Property(property="iva", type="number", format="float", example=21),
 *                     @OA\Property(property="subtotal", type="number", format="float", example=200),
 *                     @OA\Property(property="total", type="number", format="float", example=242)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Orden creada exitosamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Orden Creada Correctamente"),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="client_name", type="string", example="Juan León"),
 *                 @OA\Property(property="order_date", type="string", format="date", example="2025-04-26"),
 *                 @OA\Property(property="payment_method", type="string", example="Tarjeta de crédito"),
 *                 @OA\Property(property="discount", type="number", format="float", example=10),
 *                 @OA\Property(property="observations", type="string", example="Entrega urgente"),
 *                 @OA\Property(property="total", type="number", format="float", example=1000),
 *                 @OA\Property(
 *                     property="orderItems",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=4),
 *                         @OA\Property(property="order_id", type="integer", example=3),
 *                         @OA\Property(property="product_id", type="integer", example=1),
 *                         @OA\Property(property="quantity", type="integer", example=2),
 *                         @OA\Property(property="unit_price", type="number", format="float", example=100),
 *                         @OA\Property(property="iva", type="number", format="float", example=21),
 *                         @OA\Property(property="subtotal", type="number", format="float", example=200),
 *                         @OA\Property(property="total", type="number", format="float", example=242),
 *                         @OA\Property(property="product_name", type="string", example="Computador"),
 *                     )
 *                 )
 *             )
 *         )
 *     )
 * )
 */

	public function store(StoreOrderRequest $request)
	{
		DB::beginTransaction();

		try {
			$orderDto = new OrderDTO($request->validated());
			$order = Order::create($orderDto->toArray());
			$order->orderItems()->createMany($orderDto->orderItems);
			DB::commit();
			return response()->json(['message' => 'Orden Creada Correctamente', 'order' => $order->load('orderItems')], 201);

		} catch (\Throwable $e) {
			DB::rollback();
            return response()->json([
                'error' => 'Ocurrió un error al guardar la orden',
                'message' => $e->getMessage(),
            ], 500);
		}
	}

	/**
 * @OA\Put(
 *     path="/api/orders/{id}",
 *     summary="Actualizar una orden existente",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la orden a actualizar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"client_name", "order_date", "payment_method", "total", "orderItems"},
 *             @OA\Property(property="client_name", type="string", example="Juan León"),
 *             @OA\Property(property="order_date", type="string", format="date", example="2025-04-26"),
 *             @OA\Property(property="payment_method", type="string", example="Tarjeta de crédito"),
 *             @OA\Property(property="discount", type="number", format="float", example=10),
 *             @OA\Property(property="observations", type="string", example="Entrega urgente"),
 *             @OA\Property(property="total", type="number", format="float", example=1000),
 *             @OA\Property(
 *                 property="orderItems",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     required={"product_id", "quantity", "unit_price", "iva", "subtotal", "total"},
 *                     @OA\Property(property="id", type="integer", example=5),
 *                     @OA\Property(property="product_id", type="integer", example=1),
 *                     @OA\Property(property="quantity", type="integer", example=2),
 *                     @OA\Property(property="unit_price", type="number", format="float", example=100),
 *                     @OA\Property(property="iva", type="number", format="float", example=21),
 *                     @OA\Property(property="subtotal", type="number", format="float", example=200),
 *                     @OA\Property(property="total", type="number", format="float", example=242)
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Orden actualizada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Orden Actualizada Correctamente")
 *         )
 *     )
 * )
 */


	public function update(StoreOrderRequest $request)
	{
		$order = $request->get('order');

		// dd($request->all());

		DB::beginTransaction();
        try {
			$orderDto = new OrderDTO($request->validated());
			$order->update($orderDto->toArray());
			$CurrentOrderItems = $request->input('orderItems',[]);

			$OrderItemsIds = collect($CurrentOrderItems)->pluck('id')->filter()->toArray();

			$order->orderItems()->whereNotIn('id', $OrderItemsIds)->delete();


			foreach($CurrentOrderItems as $orderItem){
				$orderItem['order_id'] = $order->id;
				$order->orderItems()->updateOrCreate(['id' => $orderItem['id']?? null], $orderItem);
			}
			DB::commit();
            return response()->json(['message' => 'Orden Actualizada Correctamente'], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'error' => 'Ocurrió un error al actualizar la orden',
                'message' => $e->getMessage(),
            ], 500);
        }

	}

	/**
 * @OA\Delete(
 *     path="/api/orders/{id}",
 *     summary="Eliminar una orden existente",
 *     tags={"Orders"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la orden a eliminar",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Orden eliminada correctamente",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Orden Eliminada Correctamente")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Orden no encontrada",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Orden no encontrada")
 *         )
 *     )
 * )
 */

	public function destroy(Request $request)
	{
		$order = $request->get('order');

		DB::beginTransaction();
        try {
			$order->delete();
			DB::commit();
            return response()->json(['message' => 'Orden Eliminada Correctamente'], 201);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([
                'error' => 'Ocurrió un error al eliminar la orden',
                'message' => $e->getMessage(),
            ], 500);
        }

	}

}
