<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $faker = \Faker\Factory::create();
        // Crear artículos ficticios en la tabla
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => "category ". $faker->numberBetween(1,6),
                'description' => $faker->sentence(20),

            ]);
        }
    }
}
