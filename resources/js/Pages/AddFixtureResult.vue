<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {Fixture} from "@/types/app";
import Container from "@/Components/Container.vue";
import PageTitle from "@/Components/PageTitle.vue";
import {awayTeam, homeTeam} from "@/helpers/fixtures";

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
            <PageTitle title="Add fixture result"/>
        </template>

        <Container title="Score">
            <form @submit.prevent="createFixtureResult" class="space-y-4 max-w-xl">
                <p class="flex justify-between items-center">
                    <span>{{ homeTeam(fixture).name }}</span>
                    <input type="number" name="home_team_score" placeholder="home team score" v-model="form.home_team_score" class="rounded-md dark:bg-slate-700 dark:text-slate-50" />
                </p>
                <p class="flex justify-between items-center">
                    <span>{{ awayTeam(fixture).name }}</span>
                    <input type="number" name="away_team_score" placeholder="away team score" v-model="form.away_team_score" class="rounded-md dark:bg-slate-700 dark:text-slate-50" />
                </p>
                <button type="submit" class="bg-amber-300 shadow rounded-lg px-4 py-2">Add fixture result</button>
            </form>
        </Container>
    </AuthenticatedLayout>
</template>
