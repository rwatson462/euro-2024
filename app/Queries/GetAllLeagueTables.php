<?php

namespace App\Queries;

use App\Models\LeagueTable;

class GetAllLeagueTables extends CacheableQuery
{
    public const CACHE_KEY = 'league-tables';

    protected function query(): array
    {
        return LeagueTable::query()
            ->with('team', 'league')
            ->orderBy('position')
            ->get()
            ->toArray();
    }
}
