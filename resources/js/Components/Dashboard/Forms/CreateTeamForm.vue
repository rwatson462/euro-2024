<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";

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
</script>

<template>
    <form class="flex justify-between items-center" @submit.prevent="createNewTeam">
        <input type="text" placeholder="Team name" name="name" v-model="createTeamForm.name"/>
        <button type="submit">Create team</button>
    </form>
</template>
