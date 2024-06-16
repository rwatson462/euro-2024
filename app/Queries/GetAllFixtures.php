<?php

namespace App\Queries;

use App\Models\Fixture;

class GetAllFixtures
{
    public function handle(): array
    {
        return Fixture::query()
            ->with('teams', 'league', 'results')
            ->get()
            ->toArray();
    }
}
