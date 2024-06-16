<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TeamCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly string $teamId,
    ) {
        //
    }
}
