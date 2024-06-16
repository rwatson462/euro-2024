<?php

namespace App\Http\Controllers;

use App\Actions\RecalculateLeagueTable;
use Illuminate\Support\Facades\Redirect;

class RecalculateLeagueTableController
{
    public function __construct(
        private readonly RecalculateLeagueTable $recalculateLeagueTable,
    ) {
        //
    }

    public function __invoke(string $league_id)
    {
        $this->recalculateLeagueTable->handle($league_id);

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
