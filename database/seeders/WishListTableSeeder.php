<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class WishListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        WishList::truncate();

        $faker = \Faker\Factory::create();

        $users = User::all();

        foreach ($users as $user) {
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);


            WishList::create();




        }
    }
}
