<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
	protected $primaryKey = 'variantID';
	protected $fillable = [
		'productID', 'name', 'price',
	];
	protected $hidden = ['created_at', 'updated_at'];
	protected $casts = [
		'variantID' => 'integer',
		'productID' => 'integer',
		'price' => 'float',
	];

	public function Product() { return $this->belongsTo('App\Product', 'productID', 'productID'); }

	static function add($data)
	{
		$obj = new self;
		$obj->fill($data);
		$obj->save();
		return $obj;
	}

}
