<?php

namespace Database\Factories;

use App\HomeOrAway;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FixtureTeam>
 */
class FixtureTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fixture_id' => Fixture::factory(),
            'team_id' => Team::factory(),
        ];
    }

    public function home(): self
    {
        return $this->state([
            'home_or_away' => HomeOrAway::Home,
        ]);
    }

    public function away(): self
    {
        return $this->state([
            'home_or_away' => HomeOrAway::Away,
        ]);
    }
}
