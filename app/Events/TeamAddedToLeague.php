<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TeamAddedToLeague
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly string $teamId,
        public readonly string $leagueId,
    ) {
        //
    }
}
