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
        Schema::create('fixture_teams', function (Blueprint $table) {
            $table->foreignIdFor(Fixture::class);
            $table->foreignIdFor(Team::class);
            $table->string('home_or_away');

            $table->unique(['fixture_id', 'team_id']);
        });
    }
};
