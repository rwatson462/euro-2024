<?php

use App\Models\League;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('league_tables', static function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignIdFor(League::class);
            $table->integer('position');
            $table->foreignIdFor(Team::class);
            $table->integer('played');
            $table->integer('won');
            $table->integer('drawn');
            $table->integer('lost');
            $table->integer('goals_for');
            $table->integer('goals_against');
            $table->integer('goal_difference');
            $table->integer('points');

            $table->timestamps();

            $table->unique(['league_id', 'team_id']);
            $table->unique(['league_id', 'position']);
        });
    }
};
