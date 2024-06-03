<?php

namespace App\Http\Controllers;

use App\HomeOrAway;
use App\Jobs\CalculateLeagueTable;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RecalculateLeagueTableController extends Controller
{
    public function __invoke(string $league_id)
    {
        CalculateLeagueTable::dispatchSync($league_id);

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
