<script setup lang="ts">
import {Team} from "@/types/app";
import {useForm} from "@inertiajs/vue3";
import {computed} from "vue";
import Container from "@/Components/Container.vue";

const props = defineProps<{
    leagueId: string,
    leagueTeams: Team[],
    availableTeams: Team[],
}>()

const form = useForm({
    team_id: '',
})

function addTeamToLeague() {
    if (form.team_id === '') {
        alert('Must select a team')
        return
    }

    form.post(route('league.add-team', { league_id: props.leagueId }))
    form.reset()
}

const teams = computed(() => props.leagueTeams.sort((a,b) => a.name.localeCompare(b.name)))
const availableTeams = computed(() => props.availableTeams.sort((a, b) => a.name.localeCompare(b.name)))
</script>

<template>
    <Container :title="`Teams (${teams.length})`">
        <ul>
            <li v-for="(team, index) of teams" :key="index" class="flex justify-between items-center">
                <span>{{ team.name }}</span>
                <span>{{ team.id }}</span>
            </li>
        </ul>
        <form class="flex justify-between items-center" @submit.prevent="addTeamToLeague">
            <select name="team_id" v-model="form.team_id" class="dark:text-slate-900">
                <option value="" :disabled="true" :selected="true">Add a team to this league</option>
                <option v-for="(team, index) of availableTeams" :key="index" :value="team.id">
                    {{ team.name }}
                </option>
            </select>
            <button type="submit">Add team</button>
        </form>
    </Container>
</template>
