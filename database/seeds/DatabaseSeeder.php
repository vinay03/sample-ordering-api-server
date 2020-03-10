<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		$adminUser = App\User::add([
			'name'     => 'Admin',
			'role'     => 'admin',
			'email'    => 'admin@abc.com',
			'password' => '1234',
		]);
		
		$franchiseUser = App\User::add([
			'name'     => 'Franchise',
			'role'     => 'franchise',
			'email'    => 'franchise@abc.com',
			'password' => '1234',
		]);


		$pizza = App\Product::add([
			'name' => 'Pizza Base',
		]);
		$pizzaVariant1 = $pizza->addVariant([ 'name' => 'Small - 10 inches / 25 cm', 'price' => 12, ]);
		$pizzaVariant2 = $pizza->addVariant([ 'name' => 'Medium - 12 inches / 30 cm', 'price' => 18, ]);
		$pizzaVariant3 = $pizza->addVariant([ 'name' => 'Large - 14 inches / 35 cm', 'price' => 26, ]);
		$pizzaVariant4 = $pizza->addVariant([ 'name' => 'X-Large - 16 inches / 40 cm', 'price' => 35, ]);

		$pizzaTopping = App\Product::add([
			'name' => 'Pizza Topping',
		]);
		$toppingVariant1 = $pizzaTopping->addVariant([ 'name' => 'Pepperoni (200gm Pack)', 'price' => 150, ]);
		$toppingVariant2 = $pizzaTopping->addVariant([ 'name' => 'Mushrooms (1kg)', 'price' => 250, ]);
		$toppingVariant3 = $pizzaTopping->addVariant([ 'name' => 'Sausage (1kg Pack)', 'price' => 140, ]);
		$toppingVariant4 = $pizzaTopping->addVariant([ 'name' => 'Black Olives (500gm Pack)', 'price' => 420, ]);


		/* $orderData = [
			'placedByUserID' => $franchiseUser->id,
		];
		$order = App\Order::add($orderData);
		$order->addItems([
			[
				'productID' => $pizzaVariant2->productID,
				'variantID' => $pizzaVariant2->variantID,
				'rate'      => $pizzaVariant2->price,
				'quantity'  => rand(10, 15),
			],
			[
				'productID' => $pizzaVariant4->productID,
				'variantID' => $pizzaVariant4->variantID,
				'rate'      => $pizzaVariant4->price,
				'quantity'  => rand(10, 15),
			],
			[
				'productID' => $toppingVariant3->productID,
				'variantID' => $toppingVariant3->variantID,
				'rate'      => $toppingVariant3->price,
				'quantity'  => rand(10, 15),
			]
		]); */
		
	}
}
