<?php

namespace App\Actions;

use App\Enums\HomeOrAway;
use App\Enums\MatchResult;
use App\Events\ResultAdded;
use App\Queries\FindFixtureById;

class StoreResult
{
    public function __construct(
        private readonly FindFixtureById $findFixtureById,
    ) {
        //
    }

    public function handle(
        string $fixtureId,
        int $homeTeamScore,
        int $awayTeamScore,
    ): void {
        $fixture = $this->findFixtureById->handle($fixtureId);

        $homeTeamId = $fixture->teams
            ->firstWhere(fn ($team) => $team->pivot->home_or_away === HomeOrAway::Home->value)->id;
        $awayTeamId = $fixture->teams
            ->firstWhere(fn ($team) => $team->pivot->home_or_away === HomeOrAway::Away->value)->id;

        // create result for Home team
        $fixture->results()->create([
            'team_id' => $homeTeamId,
            'result' => $this->teamResult($homeTeamScore, $awayTeamScore),
            'goals_scored' => $homeTeamScore,
            'goals_conceded' => $awayTeamScore,
        ]);

        // create result for Away team
        $fixture->results()->create([
            'team_id' => $awayTeamId,
            'result' => $this->teamResult($awayTeamScore, $homeTeamScore),
            'goals_scored' => $awayTeamScore,
            'goals_conceded' => $homeTeamScore,
        ]);

        event(new ResultAdded($fixture->id));
    }

    private function teamResult($first_team_score, $second_team_score): ?MatchResult
    {
        if ($first_team_score > $second_team_score) {
            return MatchResult::Winner;
        }

        if ($first_team_score < $second_team_score) {
            return MatchResult::Loser;
        }

        return MatchResult::Draw;
    }
}
