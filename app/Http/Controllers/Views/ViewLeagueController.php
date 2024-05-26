<?php

namespace App\Http\Controllers\Views;

use App\Models\League;
use App\Models\Team;
use Inertia\Inertia;

class ViewLeagueController
{
    public function __invoke(string $league_id)
    {
        return Inertia::render('League', [
            'league' => League::with('teams')->findOrFail($league_id),
            'teams' => Team::whereDoesntHave('league')->get(),
        ]);
    }
}
