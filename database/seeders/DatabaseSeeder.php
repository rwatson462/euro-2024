<?php

namespace Database\Seeders;

use App\HomeOrAway;
use App\Jobs\CalculateLeagueTable;
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
        $this->addTeamsToLeagues();
        $this->addFixtures();
        $this->buildLeagueTables();
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

    private function addTeamsToLeagues(): void
    {
        $leagues = [
            'Euro 2024 - Group A' => [
                'Switzerland',
                'Germany',
                'Scotland',
                'Hungary',
            ],
            'Euro 2024 - Group B' => [
                'Albania',
                'Spain',
                'Croatia',
                'Italy',
            ],
            'Euro 2024 - Group C' => [
                'England',
                'Slovenia',
                'Serbia',
                'Denmark',
            ],
            'Euro 2024 - Group D' => [
                'Poland',
                'Netherlands',
                'Austria',
                'France',
            ],
            'Euro 2024 - Group E' => [
                'Belgium',
                'Slovakia',
                'Romania',
                'Ukraine',
            ],
            'Euro 2024 - Group F' => [
                'Turkey',
                'Georgia',
                'Portugal',
                'Czech Republic',
            ],
        ];

        foreach ($leagues as $league => $teams) {
            $league = League::where('name', $league)->first();

            foreach ($teams as $team) {
                $team = Team::where('name', $team)->first();
                $league->teams()->attach($team);
            }
        }
    }

    private function addFixtures(): void
    {
        $createFixture = static function (League $league, Carbon $kickoff, string $homeTeamName, string $awayTeamName): void {
            $fixture = $league->fixtures()->create(['kickoff_time' => $kickoff]);

            $fixture->teams()->attach(Team::firstWhere('name', $homeTeamName)->id, ['home_or_away' => HomeOrAway::Home]);
            $fixture->teams()->attach(Team::firstWhere('name', $awayTeamName)->id, ['home_or_away' => HomeOrAway::Away]);
        };

        $league = League::firstWhere('name', 'Euro 2024 - Group A');
        $createFixture($league, Carbon::parse('2024-06-14 20:00', 'BST')->setTimeZone('UTC'), 'Germany', 'Scotland');
        $createFixture($league, Carbon::parse('2024-06-15 14:00', 'BST')->setTimeZone('UTC'), 'Hungary', 'Switzerland');
        $createFixture($league, Carbon::parse('2024-06-19 17:00', 'BST')->setTimeZone('UTC'), 'Germany', 'Hungary');
        $createFixture($league, Carbon::parse('2024-06-19 20:00', 'BST')->setTimeZone('UTC'), 'Scotland', 'Switzerland');
        $createFixture($league, Carbon::parse('2024-06-23 20:00', 'BST')->setTimeZone('UTC'), 'Scotland', 'Hungary');
        $createFixture($league, Carbon::parse('2024-06-23 20:00', 'BST')->setTimeZone('UTC'), 'Switzerland', 'Germany');

        $league = League::firstWhere('name', 'Euro 2024 - Group B');
        $createFixture($league, Carbon::parse('2024-06-15 17:00', 'BST')->setTimeZone('UTC'), 'Spain', 'Croatia');
        $createFixture($league, Carbon::parse('2024-06-15 20:00', 'BST')->setTimeZone('UTC'), 'Italy', 'Albania');
        $createFixture($league, Carbon::parse('2024-06-19 14:00', 'BST')->setTimeZone('UTC'), 'Croatia', 'Albania');
        $createFixture($league, Carbon::parse('2024-06-20 20:00', 'BST')->setTimeZone('UTC'), 'Spain', 'Italy');
        $createFixture($league, Carbon::parse('2024-06-24 20:00', 'BST')->setTimeZone('UTC'), 'Albania', 'Spain');
        $createFixture($league, Carbon::parse('2024-06-24 20:00', 'BST')->setTimeZone('UTC'), 'Croatia', 'Italy');

        $league = League::firstWhere('name', 'Euro 2024 - Group C');
        $createFixture($league, Carbon::parse('2024-06-16 17:00', 'BST')->setTimeZone('UTC'), 'Slovenia', 'Denmark');
        $createFixture($league, Carbon::parse('2024-06-16 20:00', 'BST')->setTimeZone('UTC'), 'Serbia', 'England');
        $createFixture($league, Carbon::parse('2024-06-20 14:00', 'BST')->setTimeZone('UTC'), 'Slovenia', 'Serbia');
        $createFixture($league, Carbon::parse('2024-06-20 17:00', 'BST')->setTimeZone('UTC'), 'Denmark', 'England');
        $createFixture($league, Carbon::parse('2024-06-25 20:00', 'BST')->setTimeZone('UTC'), 'Denmark', 'Serbia');
        $createFixture($league, Carbon::parse('2024-06-25 20:00', 'BST')->setTimeZone('UTC'), 'England', 'Slovenia');

        $league = League::firstWhere('name', 'Euro 2024 - Group D');
        $createFixture($league, Carbon::parse('2024-06-16 14:00', 'BST')->setTimeZone('UTC'), 'Poland', 'Netherlands');
        $createFixture($league, Carbon::parse('2024-06-17 20:00', 'BST')->setTimeZone('UTC'), 'Austria', 'France');
        $createFixture($league, Carbon::parse('2024-06-21 17:00', 'BST')->setTimeZone('UTC'), 'Poland', 'Austria');
        $createFixture($league, Carbon::parse('2024-06-21 20:00', 'BST')->setTimeZone('UTC'), 'Netherlands', 'France');
        $createFixture($league, Carbon::parse('2024-06-25 17:00', 'BST')->setTimeZone('UTC'), 'France', 'Poland');
        $createFixture($league, Carbon::parse('2024-06-25 17:00', 'BST')->setTimeZone('UTC'), 'Netherlands', 'Austria');

        $league = League::firstWhere('name', 'Euro 2024 - Group E');
        $createFixture($league, Carbon::parse('2024-06-17 14:00', 'BST')->setTimeZone('UTC'), 'Romania', 'Ukraine');
        $createFixture($league, Carbon::parse('2024-06-17 17:00', 'BST')->setTimeZone('UTC'), 'Belgium', 'Slovakia');
        $createFixture($league, Carbon::parse('2024-06-21 14:00', 'BST')->setTimeZone('UTC'), 'Slovakia', 'Ukraine');
        $createFixture($league, Carbon::parse('2024-06-22 20:00', 'BST')->setTimeZone('UTC'), 'Belgium', 'Romania');
        $createFixture($league, Carbon::parse('2024-06-26 17:00', 'BST')->setTimeZone('UTC'), 'Slovakia', 'Romania');
        $createFixture($league, Carbon::parse('2024-06-26 17:00', 'BST')->setTimeZone('UTC'), 'Ukraine', 'Belgium');

        $league = League::firstWhere('name', 'Euro 2024 - Group F');
        $createFixture($league, Carbon::parse('2024-06-18 17:00', 'BST')->setTimeZone('UTC'), 'Turkey', 'Georgia');
        $createFixture($league, Carbon::parse('2024-06-18 20:00', 'BST')->setTimeZone('UTC'), 'Portugal', 'Czech Republic');
        $createFixture($league, Carbon::parse('2024-06-22 14:00', 'BST')->setTimeZone('UTC'), 'Georgia', 'Czech Republic');
        $createFixture($league, Carbon::parse('2024-06-22 17:00', 'BST')->setTimeZone('UTC'), 'Turkey', 'Portugal');
        $createFixture($league, Carbon::parse('2024-06-26 20:00', 'BST')->setTimeZone('UTC'), 'Czech Republic', 'Turkey');
        $createFixture($league, Carbon::parse('2024-06-26 20:00', 'BST')->setTimeZone('UTC'), 'Georgia', 'Portugal');
    }

    private function buildLeagueTables(): void
    {
        League::all()->each(fn (League $league) => dispatch(new CalculateLeagueTable($league->id)));
    }
}
