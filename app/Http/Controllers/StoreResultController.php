<?php

namespace App\Http\Controllers;

use App\Actions\StoreResult;
use App\Http\Requests\StoreResultRequest;
use App\Queries\FindFixtureById;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class StoreResultController
{
    public function __construct(
        private readonly FindFixtureById $findFixtureById,
        private readonly StoreResult $storeResult,
    ) {
        //
    }

    public function __invoke(StoreResultRequest $request, string $fixture_id): RedirectResponse
    {
        // Verify Fixture exists
        $this->findFixtureById->handle($fixture_id);

        $this->storeResult->handle(
            fixtureId: $fixture_id,
            homeTeamScore: $request->validated('home_team_score'),
            awayTeamScore: $request->validated('away_team_score'),
        );

        return Redirect::back();
    }
}
