<?php

namespace Database\Seeders;

use App\Models\DetailsBuy;
use Illuminate\Database\Seeder;

class DetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DetailsBuy::truncate();
        $faker = \Faker\Factory::create();
        // Crear artículos ficticios en la tabla
        for ($i = 0; $i < 15; $i++) {
            DetailsBuy::create([
                'details' => $faker->sentence(7),
                'subtotal' => $faker->randomFloat(3,0,8),
                'iva' => $faker->randomFloat(3,0,1),
                'total' => $faker->randomFloat(3,10,90),
                'quantity' => $faker->numberBetween(1,7),
                'products' => $faker->sentence(8,true)

            ]);
        }
}}
