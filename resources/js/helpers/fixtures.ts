import {Fixture, Team} from "@/types/app";

export function homeTeam(fixture: Fixture): Team {
    return fixture.teams.find(team => team.pivot.home_or_away === 'home')!
}

export function awayTeam(fixture: Fixture): Team {
    return fixture.teams.find(team => team.pivot.home_or_away === 'away')!
}
