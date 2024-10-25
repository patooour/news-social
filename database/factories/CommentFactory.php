<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $catIDs = User::pluck('id')->toArray();
        $randIndex = array_rand($catIDs);

        $postIDs = Post::pluck('id')->toArray();
        $randIndexPost = array_rand($postIDs);

        $date = fake()->date('Y-m-d H:i:s');

        return [
           'comment'=>fake()->paragraph(2),
           'status'=>rand(0, 1),
           'ip_address'=>fake()->ipv4(),
            'user_id'=>$catIDs[$randIndex],
            'post_id'=>$postIDs[$randIndexPost],
            'created_at'=>$date,
            'updated_at'=>$date,

        ];
    }
}
