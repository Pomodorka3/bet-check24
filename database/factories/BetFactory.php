<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bet>
 */
class BetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'match_id' => \App\Models\FootballMatch::inRandomOrder()->first()->id,
            'team_1_score' => $this->faker->numberBetween(0, 5),
            'team_2_score' => $this->faker->numberBetween(0, 5),
        ];
    }
}
