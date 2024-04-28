<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'slug' => $this->faker->slug(),
            'body' => $this->faker->paragraphs(rand(1, 5), true),
            'photo' => $this->faker->imageUrl(640, 480, true),
            'user_id' => mt_rand(1,10),
            'subject_id' => mt_rand(1,6)
        ];
    }
}
