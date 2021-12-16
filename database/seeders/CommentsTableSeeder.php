<?php

namespace Database\Seeders;

use App\Models\Comment;
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


        foreach ($users as $user) {
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);

            for ($j=0; $j < 3; $j++){
                Comment::create([
                    'content' => $faker->sentence(6),

                ]);
            }




        }
    }
}


