<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
	function user(Request $req)
	{
		$user = Auth::user();
		return response()->json([
			'user' => $user
		]);
	}

	function login(Request $req)
	{
		$response =  Auth::attempt([
			'email'    => $req->email,
			'password' => $req->password,
		]);
		$user = Auth::user();
		return response()->json([
			'response' => $response,
			'user'     => Auth::user(),
			'token'    => $user->api_token,
		]);
	}

	function logout(Request $req)
	{
		return response()->json([
			'user'     => Auth::user(),
		]);
		return Auth::logout();
	}
}
