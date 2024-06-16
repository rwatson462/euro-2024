<?php

namespace App\Queries;

use App\Models\Team;

class GetAllTeams
{
    public function handle(): array
    {
        return Team::all()->toArray();
    }
}
