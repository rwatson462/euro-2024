<?php

namespace App\Http\Controllers;

use App\Actions\CreateFixture;
use App\Http\Requests\CreateFixtureRequest;
use Illuminate\Support\Facades\Redirect;

class CreateFixtureController
{
    public function __construct(
        private readonly CreateFixture $createFixture
    ) {
        //
    }

    public function __invoke(CreateFixtureRequest $request, string $league_id)
    {
        $fixtureData = $request->validated();

        $this->createFixture->handle(
            leagueId: $league_id,
            kickoffTime: $request->validated('kickoff_time'),
            homeTeamId: $request->validated('home_team_id'),
            awayTeamId: $request->validated('away_team_id'),
        );

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
