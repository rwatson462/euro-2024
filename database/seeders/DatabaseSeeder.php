<?php

namespace Database\Seeders;

use App\Models\League;
use App\Models\Team;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Ruleset;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rob Watson',
            'email' => 'rob.watson@me.com',
            'password' => Hash::make('password'),
        ]);

        $this->createTeams();
        $this->createLeagues();
    }

    private function createTeams(): void
    {
        $teams = [
            'England',
            'Germany',
            'Scotland',
            'Hungary',
            'Switzerland',
            'Spain',
            'Croatia',
            'Italy',
            'Albania',
            'Slovenia',
            'Serbia',
            'Denmark',
            'Poland',
            'Netherlands',
            'Austria',
            'France',
            'Belgium',
            'Slovakia',
            'Romania',
            'Ukraine',
            'Turkey',
            'Georgia',
            'Portugal',
            'Czech Republic',
        ];

        foreach ($teams as $team) {
            Team::create([
                'name' => $team,
            ]);
        }
    }

    private function createLeagues(): void
    {
        $leagues = [
            'Euro 2024 - Group A',
            'Euro 2024 - Group B',
            'Euro 2024 - Group C',
            'Euro 2024 - Group D',
            'Euro 2024 - Group E',
            'Euro 2024 - Group F',
        ];

        $startDate = Carbon::createFromDate('2024-06-14');
        $endDate = Carbon::createFromDate('2024-06-26');

        foreach ($leagues as $league) {
            League::create([
                'name' => $league,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'ruleset' => Ruleset::Football,
                'slug' => Str::slug($league),
            ]);
        }
    }
}
