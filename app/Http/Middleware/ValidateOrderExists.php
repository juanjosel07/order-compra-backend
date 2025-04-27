<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateOrderExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		$orderId = $request->route('order');
		$order = Order::find($orderId);
		if(!Order::find($orderId)){
			return response()->json(
				[
					'success' => false,
					'message' => 'Order no Encontrada',
					]
					,404);
				}
		$request->attributes->add(['order' => $order]);
        return $next($request);
    }
}
