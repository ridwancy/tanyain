<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->paragraphs(rand(4, 8), true),
            'photo' => $this->faker->imageUrl(640, 480, true),
            'user_id' => mt_rand(1,10),
            'question_id' => mt_rand(1,20)
        ];
    }
}
