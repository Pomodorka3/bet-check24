<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FootballMatch>
 */
class FootballMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_1_id' => Team::inRandomOrder()->first()->id,
            'team_2_id' => Team::inRandomOrder()->first()->id,
            'team_1_score' => null,
            'team_2_score' => null,
            'starts_at' => $this->faker->dateTime(),
            'evaluated' => false
        ];
    }
}
