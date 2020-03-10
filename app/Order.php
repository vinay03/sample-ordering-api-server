<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
	protected $primaryKey = 'orderID';
	protected $fillable = [
		'total', 'status', 'placedByUserID', 'placedAt', 'approvedByUserID', 'approvedAt',
	];
	protected $hidden = ['created_at', 'updated_at'];
	protected $casts = [
		'orderID'          => 'integer',
		'total'            => 'float',
		'placedByUserID'   => 'integer',
		'placedAt'         => 'datetime',
		'approvedByUserID' => 'integer',
		'approvedAt'       => 'datetime',
	];

	public function Creator() { return $this->hasOne('App\User', 'id', 'placedByUserID'); }
	public function Approver() { return $this->hasOne('App\User', 'id', 'approvedByUserID'); }
	public function Items() { return $this->hasMany('App\OrderItem', 'orderID', 'orderID'); }

	static function add($data)
	{
		$obj = new self;
		$obj->fill($data);
		$obj->total = 0;
		$obj->placedAt = Carbon::now()->format('Y-m-d H:i:s');
		$obj->save();
		return $obj;
	}

	function addItems($items)
	{
		$total = 0;
		foreach($items as $item)
		{
			$itemTotal = $item['rate'] * $item['quantity'];
			$item['itemTotal'] = $itemTotal;
			$item['orderID'] = $this->orderID;
			$item = OrderItem::add($item);
			if($item) 
			{
				$total += $itemTotal;
			}
		}
		$this->total = $this->total + $total;
		$this->save();
	}
}
