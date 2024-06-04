<?php

namespace App\Jobs;

use App\MatchResult;
use App\Models\Fixture;
use App\Models\League;
use App\Models\LeagueTable;
use App\Models\Team;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateLeagueTable //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly string $leagueId,
    ) {
        //
    }

    public function handle(): void
    {
        /** @var League $league */
        $league = League::findOrFail($this->leagueId);

        // for each team in the league, get their match results, calculate stats and update the league table
        $leagueTableRecords = $league->teams->map(
            fn (Team $team) => $league
                ->matches()
                ->whereHas('teams', fn ($query) => $query->where('team_id', $team->id))
                ->get()
                ->reduce(function (array $leagueTable, Fixture $match) use ($team) {
                    $teamResult = $match->results->where('team_id', $team->id)->first();

                    if ($teamResult === null) {
                        return $leagueTable;
                    }

                    // played
                    $leagueTable['played']++;

                    // won/lost/drawn
                    if ($teamResult->result === MatchResult::Winner) {
                        $leagueTable['won']++;
                        $leagueTable['points'] += 3;
                    } elseif ($teamResult->result === MatchResult::Loser) {
                        $leagueTable['lost']++;
                    } else {
                        $leagueTable['drawn']++;
                        $leagueTable['points']++;
                    }

                    // goals for/against
                    $leagueTable['goals_for'] += $teamResult->goals_scored;
                    $leagueTable['goals_against'] += $teamResult->goals_conceded;

                    $leagueTable['goal_difference'] += $teamResult->goals_scored - $teamResult->goals_conceded;

                    return $leagueTable;
                }, [
                    'team_id' => $team->id,
                    'played' => 0,
                    'won' => 0,
                    'drawn' => 0,
                    'lost' => 0,
                    'goal_difference' => 0,
                    'goals_for' => 0,
                    'goals_against' => 0,
                    'points' => 0,
                    'league_id' => $league->id,
                ])
        )->sort(fn ($a, $b) => ($b['points']) <=> ($a['points'])
            // first tie-breaker is "highest number of points among the matches played between tied teams"
            // second tie-breaker is "goal difference among the matches played between tied teams"
            // third tie-breaker is "highest number of goals scored among the matches played between tied teams"
                ?: ($b['goal_difference']) <=> ($a['goal_difference'])
                ?: $b['goals_for'] <=> $a['goals_for']
        )->values()  // reset array keys is important for figuring out the position of each team
            ->map(fn ($record, int $key) => [
                ...$record,
                'position' => $key + 1,
            ])
            ->sort(fn ($a, $b) => $a['position'] <=> $b['position']);

        // delete existing league table records
        LeagueTable::whereLeagueId($league->id)->delete();
        $leagueTableRecords->each(fn ($record) => LeagueTable::create($record));
    }
}
