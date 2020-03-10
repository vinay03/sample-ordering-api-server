<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	protected $primaryKey = 'orderItemID';
	protected $fillable = [
		'orderID', 'productID', 'variantID', 'quantity', 'rate', 'itemTotal',
	];
	protected $hidden = ['created_at', 'updated_at'];
	protected $casts = [
		'orderItemID' => 'integer',
		'orderID'     => 'integer',
		'productID'   => 'integer',
		'variantID'   => 'integer',
		'quantity'    => 'float',
		'rate'        => 'float',
		'itemTotal'   => 'float',
	];

	public function Order() { return $this->hasOne('App\Order', 'orderID', 'orderID'); }
	public function Product() { return $this->hasOne('App\Product', 'productID', 'productID'); }
	public function Variant() { return $this->hasOne('App\Variant', 'variantID', 'variantID'); }

	static function add($data)
	{
		$obj = new self;
		$obj->fill($data);
		$obj->save();
		return $obj;
	}
}
