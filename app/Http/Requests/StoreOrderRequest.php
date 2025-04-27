<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;


class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
		$rules = [
			'client_name' => ['required', 'string', 'max:255'],
			'order_date' => ['required', 'date'],
			'payment_method' => ['required', 'string', 'max:255'],
			'discount' => ['required', 'numeric'],
			'observations' => ['nullable', 'string'],
			'total' => ['required', 'numeric'],
			'orderItems' => ['required', 'array', 'min:1'],
			'orderItems.*.product_id' => ['required', 'exists:products,id'],
			'orderItems.*.quantity' => ['required', 'numeric', 'min:1'],
			'orderItems.*.unit_price' => ['required', 'numeric', 'min:1'],
			'orderItems.*.iva' => ['required', 'numeric'],
			'orderItems.*.subtotal' => ['required', 'numeric', 'min:1'],
			'orderItems.*.total' => ['required', 'numeric', 'min:1'],

		];

		return $rules;

    }

	public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->count() === 0) {
					$productsId = collect($this->orderItems)->pluck('product_id');
					if(count($productsId) != $productsId->unique()->count()){
						$validator->errors()->add('orderItems', 'Los productos de la orden deben ser únicos.');
					}
                }
            }
        ];
    }
	public function messages():array
	{
		return [
			'client_name.required' => 'El nombre del cliente es obligatorio.',
			'client_name.string' => 'El nombre del cliente debe ser una cadena de texto.',
			'client_name.max' => 'El nombre del cliente no debe tener más de 255 caracteres.',
			'order_date.required' => 'La fecha de la orden es obligatoria.',
			'order_date.date' => 'La fecha de la orden debe ser una fecha válida.',
			'payment_method.required' => 'El método de pago es obligatorio.',
			'payment_method.string' => 'El método de pago debe ser una cadena de texto.',
			'payment_method.max' => 'El método de pago no debe tener más de 255 caracteres.',
			'discount.required' => 'El descuento es obligatorio.',
			'discount.numeric' => 'El descuento debe ser un número.',
			'observations.string' => 'Las observaciones deben ser una cadena de texto.',
			'total.required' => 'El total es obligatorio.',
			'total.numeric' => 'El total debe ser un número.',
			'orderItems.required' => 'Los productos de la orden son obligatorios.',
			'orderItems.array' => 'Los productos de la orden deben ser un array.',
			'orderItems.min' => 'Los productos de la orden deben tener al menos 1 item.',
			'orderItems.*.product_id.required' => 'El id del producto es obligatorio.',
			'orderItems.*.product_id.exists' => 'El id del producto no existe.',
			'orderItems.*.quantity.required' => 'La cantidad es obligatoria.',
			'orderItems.*.quantity.numeric' => 'La cantidad debe ser un número.',
			'orderItems.*.quantity.min' => 'La cantidad debe ser mayor a 0.',
			'orderItems.*.unit_price.required' => 'El precio unitario es obligatorio.',
			'orderItems.*.unit_price.numeric' => 'El precio unitario debe ser un número.',
			'orderItems.*.unit_price.min' => 'El precio unitario debe ser mayor a 0.',
			'orderItems.*.iva.required' => 'El IVA es obligatorio.',
			'orderItems.*.iva.numeric' => 'El IVA debe ser un número.',
			'orderItems.*.subtotal.required' => 'El subtotal es obligatorio.',
			'orderItems.*.subtotal.numeric' => 'El subtotal debe ser un número.',
			'orderItems.*.subtotal.min' => 'El subtotal debe ser mayor a 0.',
			'orderItems.*.total.required' => 'El total es obligatorio.',
			'orderItems.*.total.numeric' => 'El total debe ser un número.',
			'orderItems.*.total.min' => 'El total debe ser mayor a 0.',
		];
	}
}
