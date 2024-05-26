<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AddTeamToLeagueController extends Controller
{
    public function __invoke(Request $request, string $league_id)
    {
        $team = $request->validate([
            'team_id' => 'required|string',
        ]);

        League::findOrFail($league_id)->teams()->attach(Team::findOrFail($team['team_id']));

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
