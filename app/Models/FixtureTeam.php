<?php

namespace App\Models;

use App\HomeOrAway;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property HomeOrAway $home_or_away
 */
class FixtureTeam extends Model
{
    use HasFactory;

    public $guarded = [];

    public function casts(): array
    {
        return [
            'home_or_away' => HomeOrAway::class,
        ];
    }
}
