<?php

namespace App\Http\Controllers;

use App\Actions\AddTeamToLeague;
use App\Http\Requests\AddTeamToLeagueRequest;
use Illuminate\Support\Facades\Redirect;

class AddTeamToLeagueController
{
    public function __construct(
        private readonly AddTeamToLeague $addTeamToLeague,
    ) {
        //
    }

    public function __invoke(AddTeamToLeagueRequest $request, string $league_id)
    {
        $this->addTeamToLeague->handle(
            leagueId: $league_id,
            teamId: $request->validated('team_id'),
        );

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
