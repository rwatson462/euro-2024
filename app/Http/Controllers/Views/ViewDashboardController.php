<?php

namespace App\Http\Controllers\Views;

use App\Models\Fixture;
use App\Models\League;
use App\Models\Team;
use Inertia\Inertia;

class ViewDashboardController
{
    public function __invoke()
    {
        return Inertia::render('Dashboard', [
            'teams' => Team::all(),
            'leagues' => League::all(),
            'fixtures' => Fixture::with('teams', 'league')->get(),
        ]);
    }
}
