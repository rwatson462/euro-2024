<script setup lang="ts">
import {Team} from "@/types/app";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";

const props = defineProps<{
    teams: Team[],
}>()

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

// sort teams by name
const teams = computed(() => props.teams.sort((a,b) => a.name.localeCompare(b.name)))
</script>

<template>
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
</template>
