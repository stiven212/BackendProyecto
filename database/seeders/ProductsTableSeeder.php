<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Category;
use App\Models\Product;
use App\Models\WishList;
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
//        Product::truncate();
        $faker = \Faker\Factory::create();
        // Crear artículos ficticios en la tabla


        $categories = Category::all();

        foreach ($categories as $category){

        for ($i = 0; $i < 10; $i++) {




            Product::create([
                'name' => 't-shirt size '.$faker->randomLetter,
                'description' => $faker->company,
                'color' => $faker->colorName,
                'price' => $faker->numberBetween(10,100),
                'sale' => $faker->numberBetween(30,200),


                'category_id' => $category->id,


            ]);
            }

            }

        }


}
