<?php

namespace Database\Factories;

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

    public function forFixture(Fixture $fixture): self
    {
        return $this->state([
            'fixture_id' => $fixture->id,
        ]);
    }
}
