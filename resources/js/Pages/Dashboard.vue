<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Container from "@/Components/Container.vue";
import {formatDate} from "../helpers/date";

const props = defineProps<{
    teams: { id: string, name: string }[];
    leagues: { id: string, name: string }[];
    fixtures: {
        id: string,
        kickoff_time: string,
        home_team_id: string,
        away_team_id: string,
        league: {
            name: string;
        }
        teams: {
            id: string,
            name: string,
            pivot: {
                home_or_away: "home"|"away",
            },
        }[],
    }[],
}>()

const createTeamForm = useForm({
    name: '',
})

function createNewTeam() {
    if (createTeamForm.name === '') {
        alert('Must add a team name')
        return
    }

    createTeamForm.post(route('dashboard.create-team'))
    createTeamForm.reset()
}

const createLeagueForm = useForm({
    name: '',
    start_date: '',
    end_date: '',
})

function createNewLeague() {
    if (createLeagueForm.name === '') {
        alert('Must add a league name')
        return
    }

    createLeagueForm.post(route('dashboard.create-league'))
    createLeagueForm.reset()
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <Container :title="`Leagues (${leagues.length})`">
            <ul>
                <li v-for="(league, index) of props.leagues" :key="index" class="flex justify-between items-center">
                    <Link :href="route('league.view', {'league_id': league.id})" class="text-sky-600 hover:text-gray-600">{{ league.name }}</Link>
                    <span>{{ league.id }}</span>
                </li>
            </ul>

            <form class="flex justify-between items-center" @submit.prevent="createNewLeague">
                <input type="text" placeholder="League name" name="name" v-model="createLeagueForm.name"/>
                <input type="date" placeholder="Start date" name="start_date" v-model="createLeagueForm.start_date"/>
                <input type="date" placeholder="End date" name="end_date" v-model="createLeagueForm.end_date"/>
                <button type="submit">Create league</button>
            </form>
        </Container>
        <Container :title="`Teams (${teams.length})`">
            <ul>
                <li v-for="(team, index) of props.teams" :key="index" class="flex justify-between items-center">
                    <span>{{ team.name }}</span>
                    <span>{{ team.id }}</span>
                </li>
            </ul>
            <form class="flex justify-between items-center" @submit.prevent="createNewTeam">
                <input type="text" placeholder="Team name" name="name" v-model="createTeamForm.name"/>
                <button type="submit">Create team</button>
            </form>
        </Container>
        <Container :title="`Fixtures (${fixtures.length})`">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left">Group</th>
                        <th class="text-left">Kickoff time</th>
                        <th class="text-center">Home team</th>
                        <th class="text-center">Away team</th>
                        <th class="text-right">Fixture ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(fixture, index) of props.fixtures.sort((a,b) => a.kickoff_time.localeCompare(b.kickoff_time))" :key="index">
                        <td class="text-left">{{ fixture.league?.name }}</td>
                        <td class="text-left">{{ formatDate(fixture.kickoff_time) }}</td>
                        <td class="text-center">{{ fixture.teams.find(team => team.pivot.home_or_away === 'home')!.name }}</td>
                        <td class="text-center">{{ fixture.teams.find(team => team.pivot.home_or_away === 'away')!.name }}</td>
                        <td class="text-right">{{ fixture.id }}</td>
                    </tr>
                </tbody>
            </table>
        </Container>
    </AuthenticatedLayout>
</template>
