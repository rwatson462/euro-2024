<?php

use App\Actions\AddTeamToLeague;
use App\Events\TeamAddedToLeague;
use App\Models\League;
use App\Models\Team;
use Illuminate\Support\Facades\Event;

it('adds a Team, emits Domain Event', function () {
    Event::fake();

    /** @var League $league */
    $league = League::factory()->create();

    /** @var Team $team */
    $team = Team::factory()->create();

    /** @var AddTeamToLeague $action */
    $action = app(AddTeamToLeague::class);

    $action->handle(
        leagueId: $league->id,
        teamId: $team->id,
    );

    expect(League::find($league->id)->teams()->whereTeamId($team->id)->exists())->toBeTrue();

    Event::assertDispatched(TeamAddedToLeague::class);
});
