<?php

namespace App\Actions;

use App\Enums\Ruleset;
use App\Events\LeagueCreated;
use App\Models\League;
use DateTimeInterface;
use Illuminate\Support\Str;

class CreateLeague
{
    public function handle(
        string $name,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
    ): void {
        $league = League::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'ruleset' => Ruleset::Football,
        ]);

        event(new LeagueCreated($league->id));
    }
}
