<?php

namespace App\Queries;

use App\Models\LeagueTable;

class FindLeagueTableByLeagueId
{
    public function handle(string $leagueId): array
    {
        return LeagueTable::query()
            ->with('team')
            ->where('league_id', $leagueId)
            ->orderBy('position')
            ->get()
            ->toArray();
    }
}
