<?php

namespace App\Listeners;

use App\Events\ResultAdded;
use App\Jobs\CalculateLeagueTable;
use App\Queries\FindFixtureById;

class UpdateLeagueTable
{
    public function __construct(
        private readonly FindFixtureById $findFixtureById,
    ) {
        //
    }

    public function handle(ResultAdded $event): void
    {
        $fixture = $this->findFixtureById->handle($event->fixtureId);

        dispatch(new CalculateLeagueTable($fixture->league_id));
    }
}
