<?php

namespace App\Http\Controllers;

use App\HomeOrAway;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CreateFixtureController extends Controller
{
    public function __invoke(Request $request, string $league_id)
    {
        $fixtureData = $request->validate([
            'home_team_id' => 'required|string',
            'away_team_id' => 'required|string',
            'kickoff_time' => 'required|date',
        ]);

        $fixture = League::findOrFail($league_id)->fixtures()->create([
            'kickoff_time' => $fixtureData['kickoff_time'],
        ]);

        $fixture->teams()->attach($fixtureData['home_team_id'], ['home_or_away' => HomeOrAway::Home]);
        $fixture->teams()->attach($fixtureData['away_team_id'], ['home_or_away' => HomeOrAway::Away]);

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
