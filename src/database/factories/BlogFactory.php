<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Blog;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2]),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
        ];
    }
}
