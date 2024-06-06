<?php

namespace App\Http\Controllers;

use App\Events\ResultAdded;
use App\HomeOrAway;
use App\MatchResult;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StoreResultController extends Controller
{
    public function __invoke(Request $request, string $fixture_id)
    {
        /** @var Fixture $fixture */
        $fixture = Fixture::with('teams')->findOrFail($fixture_id);

        $resultData = $request->validate([
            'home_team_score' => 'required|int|min:0',
            'away_team_score' => 'required|int|min:0',
        ]);

        $homeTeamId = $fixture->teams
            ->firstWhere(fn ($team) => $team->pivot->home_or_away === HomeOrAway::Home->value)->id;
        $awayTeamId = $fixture->teams
            ->firstWhere(fn ($team) => $team->pivot->home_or_away === HomeOrAway::Away->value)->id;

        // create result for Home team
        $fixture->results()->create([
            'team_id' => $homeTeamId,
            'result' => $this->teamResult($resultData['home_team_score'], $resultData['away_team_score']),
            'goals_scored' => $resultData['home_team_score'],
            'goals_conceded' => $resultData['away_team_score'],
        ]);

        // create result for Away team
        $fixture->results()->create([
            'team_id' => $awayTeamId,
            'result' => $this->teamResult($resultData['away_team_score'], $resultData['home_team_score']),
            'goals_scored' => $resultData['away_team_score'],
            'goals_conceded' => $resultData['home_team_score'],
        ]);

        event(new ResultAdded($fixture));

        return Redirect::route('league.view', ['league_id' => $fixture->league_id]);
    }

    private function teamResult($first_team_score, $second_team_score): ?MatchResult
    {
        if ($first_team_score > $second_team_score) {
            return MatchResult::Winner;
        }

        if ($first_team_score < $second_team_score) {
            return MatchResult::Loser;
        }

        return null;
    }
}
