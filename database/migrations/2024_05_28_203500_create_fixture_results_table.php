<?php

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixture_results', static function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignIdFor(Fixture::class);
            $table->foreignIdFor(Team::class);

            $table->string('result'); // MatchResult::Winner, MatchResult::Loser, MatchResult::Draw
            $table->integer('goals_scored');
            $table->integer('goals_conceded');

            $table->timestamps();

            $table->unique(['fixture_id', 'team_id']);
        });
    }
};
