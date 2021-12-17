<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use App\Models\WishList;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Comment::truncate();

        $faker = \Faker\Factory::create();

        $users = User::all();

        $products = Product::all();

        foreach ($users as $user) {
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            foreach ($products as $product){
                Comment::create([
                    'content' => $faker->sentence(6),
                    'product_id' => $product->id,

                ]);
            }




        }
    }
}


