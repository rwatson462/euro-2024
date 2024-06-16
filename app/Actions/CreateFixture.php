<?php

namespace App\Actions;

use App\Enums\HomeOrAway;
use App\Events\FixtureCreated;
use App\Models\Fixture;
use App\Models\FixtureTeam;
use App\Models\League;
use DateTimeInterface;

class CreateFixture
{
    public function handle(
        string $leagueId,
        DateTimeInterface $kickoffTime,
        string $homeTeamId,
        string $awayTeamId,
    ): void {
        // Confirm the League exists
        League::findOrFail($leagueId);

        $fixture = Fixture::create([
            'league_id' => $leagueId,
            'kickoff_time' => $kickoffTime,
        ]);

        FixtureTeam::create([
            'fixture_id' => $fixture->id,
            'team_id' => $homeTeamId,
            'home_or_away' => HomeOrAway::Home,
        ]);

        FixtureTeam::create([
            'fixture_id' => $fixture->id,
            'team_id' => $awayTeamId,
            'home_or_away' => HomeOrAway::Away,
        ]);

        event(new FixtureCreated($leagueId));
    }
}
