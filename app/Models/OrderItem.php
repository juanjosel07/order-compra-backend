<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class OrderItem extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'order_items';

	protected $fillable = [
		'order_id',
		'product_id',
		'quantity',
		'unit_price',
		'iva',
		'subtotal',
		'total'
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	protected $appends = ['product_name'];

	//relationship
	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function productName(): Attribute
	{
		return Attribute::make(
			get: fn () => $this->product->name,
		);
	}



}
