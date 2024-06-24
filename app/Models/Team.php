<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property string $id
 * @property string $name
 *
 * @mixin Builder
 */
class Team extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function league(): BelongsToMany
    {
        return $this->belongsToMany(League::class, 'league_teams');
    }
}
