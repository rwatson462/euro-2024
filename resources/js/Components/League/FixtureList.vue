<script setup lang="ts">
import {Fixture, Team} from "@/types/app";
import {computed} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps<{
    leagueId: string,
    fixtures: Fixture[],
    teams: Team[],
}>()

function homeTeam(fixture: Fixture) {
    return fixture.teams.find(team => team.pivot.home_or_away === 'home')!.name
}

function awayTeam(fixture: Fixture) {
    return fixture.teams.find(team => team.pivot.home_or_away === 'away')!.name
}

const form = useForm({
    kickoff_time: '',
    home_team_id: '',
    away_team_id: '',
})

function createFixture() {
    if (form.home_team_id === '' || form.away_team_id === '' || form.kickoff_time === '') {
        alert('Must select a home team, away team and a kickoff time')
        return
    }
    form.post(route('league.create-fixture', { league_id: props.leagueId }))
    form.reset()
}

const teams = computed(() => props.teams.sort((a,b) => a.name.localeCompare(b.name)))
const fixtures = computed(() => props.fixtures.sort((a,b) => a.kickoff_time.localeCompare(b.kickoff_time)))
</script>

<template>
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
                            v-for="(fixture, index) of fixtures"
                            :key="index"
                        >
                            <td class="text-left">{{ new Date(fixture.kickoff_time).toLocaleString("en-GB", {timeZone: 'UTC'})}}</td>
                            <td class="text-center">{{ homeTeam(fixture)  }}</td>
                            <td class="text-center">{{ awayTeam(fixture) }}</td>
                            <td class="text-right">{{ fixture.id }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6">
                    <form class="flex justify-between items-center" @submit.prevent="createFixture">
                        <select name="home_team_id" v-model="form.home_team_id" class="dark:text-slate-900">
                            <option value="" :disabled="true" :selected="true">Home team</option>
                            <option v-for="(team, index) of teams" :key="index" :value="team.id">
                                {{ team.name }}
                            </option>
                        </select>
                        <select name="away_team_id" v-model="form.away_team_id" class="dark:text-slate-900">
                            <option value="" :disabled="true" :selected="true">Away team</option>
                            <option v-for="(team, index) of teams" :key="index" :value="team.id">
                                {{ team.name }}
                            </option>
                        </select>
                        <input type="datetime-local" name="kickoff_time" v-model="form.kickoff_time" class="dark:text-slate-900" />
                        <button type="submit">Add fixture</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
