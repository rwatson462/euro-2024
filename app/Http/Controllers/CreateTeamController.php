<?php

namespace App\Http\Controllers;

use App\Actions\CreateTeam;
use App\Http\Requests\CreateTeamRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class CreateTeamController
{
    public function __construct(
        private readonly CreateTeam $createTeam,
    ) {
        //
    }

    public function __invoke(CreateTeamRequest $request): RedirectResponse
    {
        $this->createTeam->handle($request->validated('name'));

        return Redirect::route('dashboard');
    }
}
