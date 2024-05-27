<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {computed} from "vue";
import Dropdown from "@/Components/Dropdown.vue";

const props = defineProps<{
    league: {
        id: string,
        name: string,
        start_date: Date,
        end_date: Date,
        teams: {
            id: string,
            name: string
        }[],
        fixtures: {
            id: string,
            kickoff_time: string,
            home_team_id: string,
            away_team_id: string,
            teams: {
                id: string,
                name: string,
                pivot: {
                    home_or_away: "home"|"away",
                },
            }[],
        }[],
    };
    teams: { id: string, name: string }[];
}>()

const addTeamToLeagueForm = useForm({
    team_id: '',
})

function addTeamToLeague() {
    if (addTeamToLeagueForm.team_id === '') {
        alert('Must select a team')
        return
    }

    addTeamToLeagueForm.post(route('league.add-team', { league_id: props.league.id }))
    addTeamToLeagueForm.reset()
}

const createFixtureForm = useForm({
    kickoff_time: '',
    home_team_id: '',
    away_team_id: '',
})

function createFixture() {
    if (createFixtureForm.home_team_id === '' || createFixtureForm.away_team_id === '' || createFixtureForm.kickoff_time === '') {
        alert('Must select a home team, away team and a kickoff time')
        return
    }
    createFixtureForm.post(route('league.create-fixture', { league_id: props.league.id }))
    createFixtureForm.reset()
}

</script>

<template>
    <Head :title="league.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ league.name }}</h2>
        </template>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">League info</div>

                    <div class="p-6">
                        <p>Start date: {{ new Date(league.start_date).toLocaleDateString() }}</p>
                        <p>End date: {{ new Date(league.end_date).toLocaleDateString() }}</p>
                        <p>Number of teams: {{ league.teams.length }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">Teams ({{ league.teams.length }})</div>
                    <div class="p-6">
                        <ul>
                            <li v-for="(team, index) of props.league.teams.sort((a,b) => a.name.localeCompare(b.name))" :key="index" class="flex justify-between items-center">
                                <span>{{ team.name }}</span>
                                <span>{{ team.id }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-6">
                        <form class="flex justify-between items-center" @submit.prevent="addTeamToLeague">
                            <select name="team_id" v-model="addTeamToLeagueForm.team_id" class="dark:text-slate-900">
                                <option value="" :disabled="true" :selected="true">Add a team to this league</option>
                                <option v-for="(team, index) of teams.sort((a,b) => a.name.localeCompare(b.name))" :key="index" :value="team.id">
                                    {{ team.name }}
                                </option>
                            </select>
                            <button type="submit">Add team</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">Fixtures</div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left">Kickoff time</th>
                                    <th class="text-center">Home team</th>
                                    <th class="text-center">Away team</th>
                                    <th class="text-right">Fixture ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(fixture, index) of props.league.fixtures.sort((a,b) => a.kickoff_time.localeCompare(b.kickoff_time))"
                                    :key="index"
                                >
                                    <td class="text-left">{{ new Date(fixture.kickoff_time).toLocaleString("en-GB", {timeZone: 'UTC'})}}</td>
                                    <td class="text-center">{{ fixture.teams.find(team => team.pivot.home_or_away === 'home')!.name }}</td>
                                    <td class="text-center">{{ fixture.teams.find(team => team.pivot.home_or_away === 'away')!.name }}</td>
                                    <td class="text-right">{{ fixture.id }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6">
                        <form class="flex justify-between items-center" @submit.prevent="createFixture">
                            <select name="home_team_id" v-model="createFixtureForm.home_team_id" class="dark:text-slate-900">
                                <option value="" :disabled="true" :selected="true">Home team</option>
                                <option v-for="(team, index) of league.teams.sort((a,b) => a.name.localeCompare(b.name))" :key="index" :value="team.id">
                                    {{ team.name }}
                                </option>
                            </select>
                            <select name="away_team_id" v-model="createFixtureForm.away_team_id" class="dark:text-slate-900">
                                <option value="" :disabled="true" :selected="true">Away team</option>
                                <option v-for="(team, index) of league.teams.sort((a,b) => a.name.localeCompare(b.name))" :key="index" :value="team.id">
                                    {{ team.name }}
                                </option>
                            </select>
                            <input type="datetime-local" name="kickoff_time" v-model="createFixtureForm.kickoff_time" class="dark:text-slate-900" />
                            <button type="submit">Add fixture</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
