<?php

namespace Database\Seeders;

use App\Models\OrderBuy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

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
       // OrderBuy::truncate();
        $faker = \Faker\Factory::create();

        $users = User::all();

        foreach ($users as $user) {
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);


            $num_orders = 3;
            for($j = 0; $j < $num_orders; $j++){
                OrderBuy::create([
                    'address' => $faker->address,
                ]);
            }



        }

    }
}
