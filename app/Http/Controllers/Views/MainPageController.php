<?php

namespace App\Http\Controllers\Views;

use App\Queries\GetAllLeagues;
use App\Queries\GetAllLeagueTables;
use Inertia\Inertia;
use Inertia\Response;

class MainPageController
{
    public function __construct(
        private readonly GetAllLeagues $getAllLeagues,
        private readonly GetAllLeagueTables $getAllLeagueTables,
    ) {
        //
    }

    public function __invoke(): Response
    {
        return Inertia::render('Welcome', [
            'leagueTables' => $this->getAllLeagueTables->handle(),
            'leagues' => $this->getAllLeagues->handle(),
        ]);
    }
}
