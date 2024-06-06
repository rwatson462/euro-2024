<?php

namespace App\Http\Controllers\Views;

use App\Models\Fixture;
use Inertia\Inertia;

class AddResultController
{
    public function __invoke(string $fixture_id)
    {
        /** @var Fixture $fixture */
        $fixture = Fixture::with('teams', 'results')->findOrFail($fixture_id);

        if ($fixture->results->count() > 0) {
            throw new \InvalidArgumentException('Results have already been added for this fixture');
        }

        return Inertia::render('AddFixtureResult', [
            'fixture' => $fixture,
        ]);
    }
}
