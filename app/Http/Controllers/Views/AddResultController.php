<?php

namespace App\Http\Controllers\Views;

use App\Queries\FindFixtureById;
use Inertia\Inertia;
use Inertia\Response;

class AddResultController
{
    public function __construct(
        private readonly FindFixtureById $findFixture,
    ) {
        //
    }

    public function __invoke(string $fixture_id): Response
    {
        $fixture = $this->findFixture->handle($fixture_id);

        if ($fixture->results->count() > 0) {
            throw new \InvalidArgumentException('Results have already been added for this fixture');
        }

        return Inertia::render('AddFixtureResult', [
            'fixture' => $fixture,
        ]);
    }
}
