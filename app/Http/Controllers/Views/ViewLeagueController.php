<?php

namespace App\Http\Controllers\Views;

use App\Queries\FindLeagueById;
use App\Queries\FindLeagueTableByLeagueId;
use App\Queries\GetTeamsNotAttachedToLeagues;
use Inertia\Inertia;
use Inertia\Response;

class ViewLeagueController
{
    public function __construct(
        private readonly FindLeagueById $findLeague,
        private readonly GetTeamsNotAttachedToLeagues $getTeamsNotAttachedToLeagues,
        private readonly FindLeagueTableByLeagueId $findLeagueTableByLeagueId,
    ) {
        //
    }

    public function __invoke(string $league_id): Response
    {
        return Inertia::render('League', [
            'league' => $this->findLeague->handle($league_id),
            'teams' => $this->getTeamsNotAttachedToLeagues->handle(),
            'table' => $this->findLeagueTableByLeagueId->handle($league_id),
        ]);
    }
}
