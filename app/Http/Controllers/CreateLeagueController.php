<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Ruleset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CreateLeagueController extends Controller
{
    public function __invoke(Request $request)
    {
        $league = $request->validate([
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        League::create([
            ...$league,
            'slug' => Str::slug($league['name']),
            'ruleset' => Ruleset::Football,
        ]);

        return Redirect::route('dashboard');
    }
}
