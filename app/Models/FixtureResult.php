<?php

namespace App\Models;

use App\MatchResult;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $fixture_id
 * @property Fixture $fixture
 * @property string $team_id
 * @property Team $team
 * @property MatchResult $result
 * @property int $goal_scored
 * @property int $goal_conceded
 */
class FixtureResult extends Model
{
    use HasFactory, HasUuids;

    public $guarded = ['id'];

    public function casts(): array
    {
        return [
            'result' => MatchResult::class,
        ];
    }
}
