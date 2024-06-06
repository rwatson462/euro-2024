<?php

namespace App\Http\Controllers;

use App\Jobs\CalculateLeagueTable;
use Illuminate\Support\Facades\Redirect;

class RecalculateLeagueTableController extends Controller
{
    public function __invoke(string $league_id)
    {
        dispatch(new CalculateLeagueTable($league_id));

        return Redirect::route('league.view', ['league_id' => $league_id]);
    }
}
