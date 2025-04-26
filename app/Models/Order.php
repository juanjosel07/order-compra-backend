<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use HasFactory,SoftDeletes;

	protected $table = 'orders';

	protected $fillable = [
		'client_name',
		'order_date',
		'payment_method',
		'discount',
		'total',
		'observations'
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];
	// relationship
	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}
}
