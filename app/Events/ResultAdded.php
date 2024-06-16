<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResultAdded
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly string $fixtureId,
    ) {
        //
    }
}
