<?php

namespace App\Http\Controllers;

use App\Actions\CreateLeague;
use App\Http\Requests\CreateLeagueRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CreateLeagueController
{
    public function __construct(
        private readonly CreateLeague $createLeague,
    ) {
        //
    }

    public function __invoke(CreateLeagueRequest $request): RedirectResponse
    {
        $this->createLeague->handle(
            name: $request->validated('name'),
            startDate: $request->validated('start_date'),
            endDate: $request->validated('end_date'),
        );

        return Redirect::route('dashboard');
    }
}
