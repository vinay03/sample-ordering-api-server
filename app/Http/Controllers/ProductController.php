<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class ProductController extends Controller
{
	function products(Request $req)
	{
		$products = App\Product::with('Variants')->get()->all();
		
		return response()->json([
			'products' => $products,
		]);
	}
}
