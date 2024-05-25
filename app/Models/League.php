<?php

namespace App\Models;

use App\Ruleset;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 * @property string $ruleset
 * @property Carbon $start_date
 * @property Carbon $end_date
 */
class League extends Model
{
    use HasFactory, HasUuids;

    public $guarded = ['id'];

    public function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'ruleset' => Ruleset::class,
        ];
    }
}
