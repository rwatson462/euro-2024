<?php

namespace App\Queries;

use App\Models\Team;

class GetTeamsNotAttachedToLeagues
{
    public function handle(): array
    {
        return Team::query()
            ->whereDoesntHave('league')
            ->get()
            ->toArray();
    }
}
