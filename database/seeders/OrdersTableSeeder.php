<?php

namespace Database\Seeders;

use App\Models\OrderBuy;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        OrderBuy::truncate();
        $faker = \Faker\Factory::create();
        // Crear artículos ficticios en la tabla
        for ($i = 0; $i < 15; $i++) {
            OrderBuy::create([
                'address' => $faker->address,


            ]);
        }
    }
}
