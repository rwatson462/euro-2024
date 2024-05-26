<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $league_id
 * @property string $team_id
 */
class LeagueTeam extends Model
{
    use HasFactory;

    public $guarded = [];
}
