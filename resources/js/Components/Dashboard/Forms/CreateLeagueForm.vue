<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";

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
    <form class="flex justify-between items-center" @submit.prevent="createNewLeague">
        <input type="text" placeholder="League name" name="name" v-model="createLeagueForm.name"/>
        <input type="date" placeholder="Start date" name="start_date" v-model="createLeagueForm.start_date"/>
        <input type="date" placeholder="End date" name="end_date" v-model="createLeagueForm.end_date"/>
        <button type="submit">Create league</button>
    </form>
</template>
