<?php

use App\Actions\CreateLeague;
use App\Events\LeagueCreated;
use App\Models\League;
use Illuminate\Support\Facades\Event;

it('creates a League, emits Domain Event', function () {
    Event::fake();

    /** @var CreateLeague $action */
    $action = app(CreateLeague::class);

    $leagueName = fake()->word();

    $action->handle(
        name: $leagueName,
        startDate: today(),
        endDate: today()->addWeek(),
    );

    expect(League::firstWhere('name', $leagueName)->exists())->toBeTrue();

    Event::assertDispatched(LeagueCreated::class);
});
