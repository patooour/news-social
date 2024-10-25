<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $postIds = Post::pluck('id')->toArray();
        $randPost = array_rand($postIds);
        $date = fake()->date('Y-m-d H:i:s');
        return [
            'path' => $this->faker->imageUrl(),
            'post_id' => $postIds[$randPost],
            'created_at'=>$date,
            'updated_at'=>$date,
            ];
    }
}
