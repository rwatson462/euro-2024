<?php

namespace App\Http\Controllers\Views;

use App\Models\League;
use App\Models\LeagueTable;
use Inertia\Inertia;

class MainPageController
{
    public function __invoke()
    {
        return Inertia::render('Welcome', [
            'leagueTables' => LeagueTable::with('team', 'league')->get(),
            'leagues' => League::with('fixtures', 'fixtures.teams', 'fixtures.results')->orderBy('name')->get(),
        ]);
    }
}
