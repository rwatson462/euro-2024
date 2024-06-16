<?php

namespace App\Actions;

use App\Events\TeamAddedToLeague;
use App\Models\League;
use App\Models\Team;

class AddTeamToLeague
{
    public function handle(
        string $leagueId,
        string $teamId,
    ): void {
        // Confirm the League exists
        $league = League::findOrFail($leagueId);

        // Confirm the Team exists
        $team = Team::findOrFail($teamId);

        $league->teams()->attach($team);

        event(new TeamAddedToLeague($league->id, $team->id));
    }
}
