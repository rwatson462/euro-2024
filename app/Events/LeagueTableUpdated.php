<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeagueTableUpdated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly string $leagueId,
    ) {
        //
    }
}
