<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property string $id
 * @property string $league_id
 * @property Carbon $kickoff_time
 * @property Collection<FixtureResult> $results
 * @property Collection<Team> $teams
 *
 * @mixin Builder
 */
class Fixture extends Model
{
    use HasFactory, HasUuids;

    public $guarded = ['id'];

    public function casts(): array
    {
        return [
            'kickoff_time' => 'datetime',
        ];
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'fixture_teams')->withPivot(['home_or_away']);
    }

    public function league(): BelongsTo
    {
        return $this->belongsTo(League::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(FixtureResult::class);
    }
}
