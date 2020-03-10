<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('user', 'UserController@user');
Route::post('user/login', 'UserController@login');
Route::post('user/logout', 'UserController@logout');

Route::group([
	'middleware' => ['auth:api']
], function () {
Route::post('user', 'UserController@user');
	Route::post('user/logout', 'UserController@logout');

	Route::post('products', 'ProductController@products');
	Route::post('order/create', 'OrderController@create');

	Route::post('orders', 'OrderController@getList');
	Route::post('order/action', 'OrderController@action');
});