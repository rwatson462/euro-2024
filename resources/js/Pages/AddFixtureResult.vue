<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {Fixture} from "@/types/app";
import Container from "@/Components/Container.vue";

const props = defineProps<{
    fixture: Fixture,
}>()

const form = useForm({
    home_team_score: '',
    away_team_score: '',
})

function createFixtureResult() {
    if (form.home_team_score === '' || form.away_team_score === '') {
        alert('Must enter a score for both teams')
        return
    }
    form.post(route('results.store', {fixture_id: props.fixture.id}))
    form.reset()
}

</script>

<template>
    <Head title="Add fixture result" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Add fixture</h2>
        </template>

        <Container title="Add fixture result">
            <pre>{{ JSON.stringify(fixture, undefined, 2) }}</pre>
            <form @submit.prevent="createFixtureResult" class="flex justify-between">
                <input type="number" name="home_team_score" placeholder="home team score" v-model="form.home_team_score" class="rounded-md dark:bg-slate-700 dark:text-slate-50" />
                <input type="number" name="away_team_score" placeholder="away team score" v-model="form.away_team_score" class="rounded-md dark:bg-slate-700 dark:text-slate-50" />
                <button type="submit">Add fixture result</button>
            </form>
        </Container>
    </AuthenticatedLayout>
</template>
