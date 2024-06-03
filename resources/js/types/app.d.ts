
export interface League {
    id: string,
    name: string,
    start_date: Date,
    end_date: Date,
    teams: Team[],
    fixtures: Fixture[],
}

export interface Team {
    id: string,
    name: string,
    pivot: {
        home_or_away: "home"|"away",
    },
}

export interface Fixture {
    id: string,
    kickoff_time: string,
    home_team_id: string,
    away_team_id: string,
    teams: Team[],
}

export interface LeagueTableRecord {
    id: string,
    league_id: string,
    team_id: string,
    played: number,
    won: number,
    drawn: number,
    lost: number,
    goals_for: number,
    goals_against: number,
    goal_difference: number,
    points: number,
    team: Team,
}
