<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $catIDs = Category::pluck('id')->toArray();
        $randIndex = array_rand($catIDs);

        $userIDs = User::pluck('id')->toArray();
        $randIndexUser = array_rand($userIDs);

        $date = fake()->date('Y-m-d H:i:s');

        return [
            'title'=>fake()->sentence(3),
            'desc'=>fake()->paragraph(5),
            'status'=>rand(0,1),
            'comment_able'=>rand(0,1),
            'num_of_views'=>rand(0,100),
            'category_id'=>Category::inRandomOrder()->first()->id,
           'user_id'=> User::inRandomOrder()->first()->id,
            // 'user_id'=> $randIndexUser[$userIDs],

            'created_at'=>$date,
            'updated_at'=>$date,
        ];
    }
}
