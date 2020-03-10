<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App;

class OrderController extends Controller
{
	function create(Request $req)
	{
		$cart = $req->cart;
		$items = [];
		foreach($cart as $key => $value)
		{
			$parts = explode('-', $key);
			$productID = $parts[0];
			$variantID = $parts[1];

			$product = App\Product::where('productID', $productID)->first();
			$variant = App\Variant::where('variantID', $variantID)->first();

			if(!$product || !$variant) {
				continue;
			}
			$items[] = [
				'productID' => $productID,
				'variantID' => $variantID,
				'rate'      => $variant->price,
				'quantity'  => $value,
			];
		}

		$success = false;
		if(count($items) > 0) 
		{
			$user = Auth::user();
			$order = App\Order::add([
				'placedByUserID' => $user->id,
				'placedAt' => Carbon::now()->format('Y-m-d H:i:s')
			]);
			$order->addItems($items);
			$success = true;
		}

		return response()->json([
			'cart' => $cart,
		]);
	}

	function getList(Request $req)
	{
		$orderID  = $req->orderID;
		
		$list = [];
		$info = [];
		$items = [];
		$products = [];

		if($orderID) {
			$info = App\Order::where('orderID', $orderID)->orderBy('placedAt', 'desc')->with(['Creator', 'Approver'])->first();
			$items = App\OrderItem::where('orderID', $orderID)->with(['Variant'])->get()->groupBy('productID')->toArray();
			$productIds = array_keys($items);
			$products = App\Product::whereIn('productID', $productIds)->get()->keyBy('productID');
		}
		else {
			$list = App\Order::orderBy('placedAt', 'desc')->with(['Creator', 'Approver'])->get();
		}
		
		return response()->json([
			'list' => $list,
			'info' => $info,
			'items' => array_values($items),
			'products' => $products,
		]);
	}

	function action(Request $req)
	{
		$orderID  = $req->orderID;
		$action  = $req->action;
		$order = App\Order::where('orderID', $orderID)->orderBy('placedAt', 'desc')->with(['Creator', 'Approver'])->first();

		$success = false;
		if($order) 
		{
			$user = Auth::user();
			if($action == 'reject')
			{
				$order->status = 'rejected';
				$order->approvedByUserID = $user->id;
				$order->approvedAt = Carbon::now()->format('Y-m-d H:i:s');
				$order->save();
				$success = true;
			}
			else if($action == 'approve')
			{
				$order->status = 'approved';
				$order->approvedByUserID = $user->id;
				$order->approvedAt = Carbon::now()->format('Y-m-d H:i:s');
				$order->save();
				$success = true;
			}
		}

		return response()->json([
			'success' => $success,
		]);
	}
}
