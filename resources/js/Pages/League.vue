<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import {League, LeagueTableRecord, Team} from "@/types/app";
import LeagueHeader from "@/Components/League/LeagueHeader.vue";
import TeamList from "@/Components/League/TeamsListContainer.vue";
import LeagueTable from "@/Components/League/LeagueTable.vue";
import FixtureListContainer from "@/Components/League/FixturesListContainer.vue";
import PageTitle from "@/Components/PageTitle.vue";

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
            <PageTitle :title="league.name"/>
        </template>

        <LeagueHeader :league="league" />
        <LeagueTable :table="table" :league-id="league.id" />
        <FixtureListContainer :fixtures="league.fixtures" :league-id="league.id" :teams="teams"/>
        <TeamList :available-teams="teams" :league-teams="league.teams" :league-id="league.id" />
    </AuthenticatedLayout>
</template>
