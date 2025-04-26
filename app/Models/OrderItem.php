<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

	//relationship
	public function order()
	{
		return $this->belongsTo(Order::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
