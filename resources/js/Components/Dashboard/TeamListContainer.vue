<script setup lang="ts">
import TeamsList from "@/Components/Dashboard/TeamsList.vue";
import {Team} from "@/types/app";
import Container from "@/Components/Container.vue";
import CreateTeamForm from "@/Components/Dashboard/Forms/CreateTeamForm.vue";

defineProps<{
    teams: Team[],
}>()
</script>

<template>
    <Container :title="`Teams (${teams.length})`">
        <TeamsList :teams="teams"/>
        <CreateTeamForm/>
    </Container>
</template>
