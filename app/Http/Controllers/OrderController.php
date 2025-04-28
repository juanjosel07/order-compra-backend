<?php

namespace App\Http\Controllers;

use App\Dto\OrderDTO;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
	public function index()
	{
		$orders = Order::query();
		return DataTables::of($orders)->toJson();
	}

	public function show( Request $request)
	{
		$order = $request->get('order');
		$order->load('orderItems');
		return response()->json(['success' => true,'order' => $order],200);
	}

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
