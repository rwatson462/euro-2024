<script setup lang="ts">
import {Team} from "@/types/app";
import {computed} from "vue";
import Container from "@/Components/Container.vue";
import TeamsList from "@/Components/Dashboard/TeamsList.vue";
import AddTeamToLeagueForm from "@/Components/League/Forms/AddTeamToLeagueForm.vue";

const {
    leagueTeams,
    availableTeams,
} = defineProps<{
    leagueId: string,
    leagueTeams: Team[],
    availableTeams: Team[],
}>()

const sortedTeams = computed(() => leagueTeams.sort((a,b) => a.name.localeCompare(b.name)))
const sortedAvailableTeams = computed(() => availableTeams.sort((a, b) => a.name.localeCompare(b.name)))
</script>

<template>
    <Container :title="`Teams (${sortedTeams.length})`">
        <TeamsList :teams="sortedTeams"/>

        <AddTeamToLeagueForm :league-id="leagueId" :available-teams="sortedAvailableTeams"/>
    </Container>
</template>
