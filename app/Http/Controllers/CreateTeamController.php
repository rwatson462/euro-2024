<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CreateTeamController extends Controller
{
    public function __invoke(Request $request)
    {
        $team = $request->validate([
            'name' => 'required|string',
        ]);

        Team::create($team);

        return Redirect::route('dashboard');
    }
}
