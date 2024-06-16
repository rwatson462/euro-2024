<?php

namespace App\Http\Controllers\Views;

use App\Queries\GetAllFixtures;
use App\Queries\GetAllLeagues;
use App\Queries\GetAllTeams;
use Inertia\Inertia;
use Inertia\Response;

class ViewDashboardController
{
    public function __construct(
        private readonly GetAllTeams $getAllTeams,
        private readonly GetAllLeagues $getAllLeagues,
        private readonly GetAllFixtures $getAllFixtures,
    ) {
        //
    }

    public function __invoke(): Response
    {
        return Inertia::render('Dashboard', [
            'teams' => $this->getAllTeams->handle(),
            'leagues' => $this->getAllLeagues->handle(),
            'fixtures' => $this->getAllFixtures->handle(),
        ]);
    }
}
