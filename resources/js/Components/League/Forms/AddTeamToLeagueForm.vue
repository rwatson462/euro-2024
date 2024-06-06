<script setup lang="ts">
import {Team} from "@/types/app";
import {useForm} from "@inertiajs/vue3";

const { leagueId } = defineProps<{
    availableTeams: Team[];
    leagueId: string;
}>()


const form = useForm({
    team_id: '',
})

function addTeamToLeague() {
    if (form.team_id === '') {
        alert('Must select a team')
        return
    }

    form.post(route('league.add-team', { league_id: leagueId }))
    form.reset()
}
</script>

<template>
    <form class="flex justify-between items-center" @submit.prevent="addTeamToLeague">
        <select name="team_id" v-model="form.team_id" class="dark:text-slate-900">
            <option value="" :disabled="true" :selected="true">Add a team to this league</option>
            <option v-for="(team, index) of availableTeams" :key="index" :value="team.id">
                {{ team.name }}
            </option>
        </select>
        <button type="submit">Add team</button>
    </form>
</template>

<style scoped>

</style>
