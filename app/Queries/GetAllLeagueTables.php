<?php

namespace App\Queries;

use App\Models\LeagueTable;

class GetAllLeagueTables
{
    public function handle(): array
    {
        return LeagueTable::query()
            ->with('team', 'league')
            ->orderBy('position')
            ->get()
            ->toArray();
    }
}
