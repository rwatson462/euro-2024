<?php

use App\Actions\StoreResult;
use App\Enums\HomeOrAway;
use App\Enums\MatchResult;
use App\Events\ResultAdded;
use App\Models\Fixture;
use App\Models\FixtureResult;
use App\Models\FixtureTeam;
use Illuminate\Support\Facades\Event;

it('stores a Result, emits Domain Event', function () {
    Event::fake();

    /** @var Fixture $fixture */
    $fixture = Fixture::factory()->create();

    FixtureTeam::factory()->forFixture($fixture)->create(['home_or_away' => HomeOrAway::Home]);
    FixtureTeam::factory()->forFixture($fixture)->create(['home_or_away' => HomeOrAway::Away]);

    /** @var StoreResult $action */
    $action = app(StoreResult::class);

    $action->handle(
        fixtureId: $fixture->id,
        homeTeamScore: 1,
        awayTeamScore: 1,
    );

    expect(FixtureResult::whereFixtureId($fixture->id)->get())->toHaveCount(2);

    Event::assertDispatched(ResultAdded::class);
});

it('correctly marks winner', function (int $homeTeamScore, MatchResult $expectedResult) {
    Event::fake();

    /** @var Fixture $fixture */
    $fixture = Fixture::factory()->create();

    FixtureTeam::factory()->forFixture($fixture)->create(['home_or_away' => HomeOrAway::Home]);
    FixtureTeam::factory()->forFixture($fixture)->create(['home_or_away' => HomeOrAway::Away]);

    /** @var StoreResult $action */
    $action = app(StoreResult::class);

    $action->handle(
        fixtureId: $fixture->id,
        homeTeamScore: $homeTeamScore,
        awayTeamScore: 2,
    );

    expect(FixtureResult::whereFixtureId($fixture->id)->first()->result)->toBe($expectedResult);
})->with([
    'home team winner' => [3, MatchResult::Winner],
    'home team loser' => [1, MatchResult::Loser],
    'home team draw' => [2, MatchResult::Draw],
]);
