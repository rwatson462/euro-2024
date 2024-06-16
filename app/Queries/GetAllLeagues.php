<?php

namespace App\Queries;

use App\Models\League;

class GetAllLeagues
{
    public function handle(): array
    {
        return League::query()
            ->with('fixtures', 'fixtures.teams', 'fixtures.results')
            ->orderBy('name')
            ->get()
            ->toArray();
    }
}
