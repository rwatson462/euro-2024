<?php

namespace App\Actions;

use App\Events\TeamCreated;
use App\Models\Team;

class CreateTeam
{
    public function handle(string $name): void
    {
        $team = Team::create([
            'name' => $name,
        ]);

        event(new TeamCreated($team->id));
    }
}
