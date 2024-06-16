<?php

use App\Actions\CreateTeam;
use App\Events\TeamCreated;
use App\Models\Team;
use Illuminate\Support\Facades\Event;

it('creates a Team, emits Domain Event', function () {
    Event::fake();

    $teamName = fake()->word();

    /** @var CreateTeam $action */
    $action = app(CreateTeam::class);

    $action->handle($teamName);

    expect(Team::where('name', $teamName)->exists())->toBeTrue();

    Event::assertDispatched(TeamCreated::class);
});
