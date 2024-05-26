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
        Schema::create('league_teams', function (Blueprint $table) {
            $table->foreignIdFor(League::class);
            $table->foreignIdFor(Team::class);

            $table->timestamps();
        });
    }
};
