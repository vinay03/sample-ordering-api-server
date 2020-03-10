<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $primaryKey = 'productID';
	protected $fillable = [
		'name',
	];
	protected $hidden = ['created_at', 'updated_at'];
	protected $casts = [
		'productID' => 'integer',
	];

	public function Variants() { return $this->hasMany('App\Variant', 'productID', 'productID'); }

	static function add($data)
	{
		$obj = new self;
		$obj->fill($data);
		$obj->save();
		return $obj;
	}

	function addVariant($data)
	{
		$variant = new Variant;
		$variant->productID = $this->productID;
		$variant->fill($data);
		$variant->save();
		return $variant;
	}
}
