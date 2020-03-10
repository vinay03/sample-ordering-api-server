<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
			$table->increments('productID');
			$table->string('name');
			$table->timestamps();
		});

		Schema::create('variants', function (Blueprint $table) {
			$table->increments('variantID');
			$table->unsignedInteger('productID')->default(0);
			$table->string('name');
			$table->decimal('price', 10, 2)->default(0.00);
			$table->timestamps();
		});

		Schema::create('orders', function (Blueprint $table) {
			$table->increments('orderID');
			$table->decimal('total', 10, 2)->default(0.00);
			$table->string('status')->default('pending');
			$table->unsignedInteger('placedByUserID')->default(0);
			$table->dateTime('placedAt')->nullable();
			$table->unsignedInteger('approvedByUserID')->default(0);
			$table->dateTime('approvedAt')->nullable();
			$table->timestamps();
		});

		Schema::create('order_items', function (Blueprint $table) {
			$table->increments('orderItemID');
			$table->unsignedInteger('orderID')->default(0);
			$table->unsignedInteger('productID')->default(0);
			$table->unsignedInteger('variantID')->default(0);
			$table->decimal('quantity', 10, 2)->default(0.00);
			$table->decimal('rate', 10, 2)->default(0.00);
			$table->decimal('itemTotal', 10, 2)->default(0.00);
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::dropIfExists('products');
		Schema::dropIfExists('variants');
		Schema::dropIfExists('orders');
		Schema::dropIfExists('order_items');
	}
}
