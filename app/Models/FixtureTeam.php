<?php

namespace App\Models;

use App\Enums\HomeOrAway;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property HomeOrAway $home_or_away
 *
 * @mixin Builder
 */
class FixtureTeam extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $guarded = ['id'];

    public function casts(): array
    {
        return [
            'home_or_away' => HomeOrAway::class,
        ];
    }
}
