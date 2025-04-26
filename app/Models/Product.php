<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

	protected $table = 'products';

	protected $fillable = [
		'name',
		'unit_price',
		'iva',
	];

	protected $hidden = [
		'created_at',
		'updated_at',
		'deleted_at',
	];

	//relationship
	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}
}
