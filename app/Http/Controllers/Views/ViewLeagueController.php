<?php

namespace App\Http\Controllers\Views;

use App\Models\League;
use App\Models\LeagueTable;
use App\Models\Team;
use Inertia\Inertia;

class ViewLeagueController
{
    public function __invoke(string $league_id)
    {
        return Inertia::render('League', [
            'league' => League::with(['teams', 'fixtures', 'fixtures.teams'])->findOrFail($league_id),
            'teams' => Team::whereDoesntHave('league')->get(),
            'table' => LeagueTable::with('team')->whereLeagueId($league_id)->get(),
        ]);
    }
}
