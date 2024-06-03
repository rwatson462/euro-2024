<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {League, LeagueTableRecord, Team} from "@/types/app";
import LeagueHeader from "@/Components/League/LeagueHeader.vue";
import TeamList from "@/Components/League/TeamList.vue";
import FixtureList from "@/Components/League/FixtureList.vue";
import LeagueTable from "@/Components/League/LeagueTable.vue";

defineProps<{
    league: League;
    teams: Team[];
    table: LeagueTableRecord[];
}>()

</script>

<template>
    <Head :title="league.name" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ league.name }}</h2>
        </template>

        <LeagueHeader :league="league" />
        <LeagueTable :table="table" :league-id="league.id" />
        <FixtureList :fixtures="league.fixtures" :league-id="league.id" :teams="teams"/>
        <TeamList :available-teams="teams" :league-teams="league.teams" :league-id="league.id" />
    </AuthenticatedLayout>
</template>
