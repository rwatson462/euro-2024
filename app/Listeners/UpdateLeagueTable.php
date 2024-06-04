<?php

namespace App\Listeners;

use App\Events\ResultAdded;
use App\Jobs\CalculateLeagueTable;

class UpdateLeagueTable
{
    public function handle(ResultAdded $event): void
    {
        dispatch(new CalculateLeagueTable($event->fixture->league_id));
    }
}
