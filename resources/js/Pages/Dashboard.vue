<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';

const props = defineProps<{
    teams: { id: string, name: string }[];
    leagues: { id: string, name: string }[];
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

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">Teams ({{ teams.length }})</div>

                    <div class="p-6">
                        <ul>
                            <li v-for="(team, index) of props.teams" :key="index" class="flex justify-between items-center">
                                <span>{{ team.name }}</span>
                                <span>{{ team.id }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-6">
                        <form class="flex justify-between items-center" @submit.prevent="createNewTeam">
                            <input type="text" placeholder="Team name" name="name" v-model="createTeamForm.name"/>
                            <button type="submit">Create team</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">Leagues ({{ leagues.length }})</div>

                    <div class="p-6">
                        <ul>
                            <li v-for="(league, index) of props.leagues" :key="index" class="flex justify-between items-center">
                                <span>{{ league.name }}</span>
                                <span>{{ league.id }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-6">
                        <form class="flex justify-between items-center" @submit.prevent="createNewLeague">
                            <input type="text" placeholder="League name" name="name" v-model="createLeagueForm.name"/>
                            <input type="date" placeholder="Start date" name="start_date" v-model="createLeagueForm.start_date"/>
                            <input type="date" placeholder="End date" name="end_date" v-model="createLeagueForm.end_date"/>
                            <button type="submit">Create league</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
