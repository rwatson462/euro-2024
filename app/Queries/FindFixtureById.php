<?php

namespace App\Queries;

use App\Models\Fixture;

class FindFixtureById
{
    public function handle(string $fixtureId): Fixture
    {
        /** @var Fixture */
        return Fixture::query()
            ->with('teams', 'results')
            ->findOrFail($fixtureId);
    }
}
