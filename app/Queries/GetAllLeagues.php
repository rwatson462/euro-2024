<?php

namespace App\Queries;

use App\Contracts\Query;
use App\Models\League;

class GetAllLeagues extends CacheableQuery
{
    public const CACHE_KEY = 'all-leagues';

    protected function query(): array
    {
        return League::query()
            ->with('fixtures', 'fixtures.teams', 'fixtures.results')
            ->orderBy('name')
            ->get()
            ->toArray();
    }
}
