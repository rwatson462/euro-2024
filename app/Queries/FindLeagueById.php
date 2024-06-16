<?php

namespace App\Queries;

use App\Models\League;

class FindLeagueById
{
    public function handle(string $leagueId): League
    {
        /** @var League */
        return League::query()
            ->with(['teams', 'fixtures', 'fixtures.teams', 'fixtures.results', 'fixtures.league'])
            ->findOrFail($leagueId);
    }
}
