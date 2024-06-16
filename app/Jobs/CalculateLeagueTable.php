<?php

namespace App\Jobs;

use App\Actions\RecalculateLeagueTable;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateLeagueTable //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly string $leagueId,
    ) {
        //
    }

    public function handle(
        RecalculateLeagueTable $recalculateLeagueTable,
    ): void {
        $recalculateLeagueTable->handle($this->leagueId);
    }
}
