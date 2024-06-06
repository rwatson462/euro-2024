<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {Fixture, League, Team} from "@/types/app";
import LeaguesListContainer from "@/Components/Dashboard/LeaguesListContainer.vue";
import TeamListContainer from "@/Components/Dashboard/TeamListContainer.vue";
import FixturesListContainer from "@/Components/Dashboard/FixturesListContainer.vue";
import PageTitle from "@/Components/PageTitle.vue";

defineProps<{
    teams: Team[];
    leagues: League[];
    fixtures: Fixture[],
}>()
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <PageTitle title="Dashboard"/>
        </template>

        <LeaguesListContainer :leagues="leagues"/>
        <TeamListContainer :teams="teams"/>
        <FixturesListContainer :fixtures="fixtures"/>
    </AuthenticatedLayout>
</template>
