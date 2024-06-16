<?php

use App\Actions\CreateFixture;
use App\Events\FixtureCreated;
use App\Models\Fixture;
use App\Models\League;
use App\Models\Team;
use Illuminate\Support\Facades\Event;

it('creates a Fixture, emits Domain Event', function () {
    Event::fake();

    /** @var League $league */
    $league = League::factory()->create();

    /** @var CreateFixture $action */
    $action = app(CreateFixture::class);

    $action->handle(
        leagueId: $league->id,
        kickoffTime: now(),
        homeTeamId: Team::factory()->create()->id,
        awayTeamId: Team::factory()->create()->id,
    );

    expect(Fixture::whereLeagueId($league->id)->firstOrFail())->toBeInstanceOf(Fixture::class);

    Event::assertDispatched(FixtureCreated::class);
});
