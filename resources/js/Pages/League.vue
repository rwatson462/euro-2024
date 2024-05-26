<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {computed} from "vue";

const props = defineProps<{
    league: { id: string, name: string, start_date: Date, end_date: Date, teams: { id: string, name: string}[] };
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
                        <p>Start date: {{ league.start_date }}</p>
                        <p>End date: {{ league.end_date }}</p>
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
                            <select name="team_id" v-model="addTeamToLeagueForm.team_id">
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
    </AuthenticatedLayout>
</template>
