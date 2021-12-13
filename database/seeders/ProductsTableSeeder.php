<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::truncate();
        $faker = \Faker\Factory::create();
        // Crear artículos ficticios en la tabla
        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => 't-shirt size '.$faker->randomLetter,
                'description' => $faker->company,
                'color' => $faker->colorName,
                'price' => $faker->numberBetween(10,100),
                'sale' => $faker->numberBetween(30,200)

            ]);
        }
    }
}
