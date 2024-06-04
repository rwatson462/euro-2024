<?php

namespace App\Events;

use App\Models\Fixture;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResultAdded
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly Fixture $fixture,
    ) {
        //
    }
}
