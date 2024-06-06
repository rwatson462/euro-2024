<script setup lang="ts">
import Container from "@/Components/Container.vue";
import {League} from "@/types/app";
import LeaguesList from "@/Components/Dashboard/LeaguesList.vue";
import CreateLeagueForm from "@/Components/Dashboard/Forms/CreateLeagueForm.vue";

defineProps<{
    leagues: League[],
}>()

</script>

<template>
    <Container :title="`Leagues (${leagues.length})`">
        <LeaguesList :leagues="leagues" />
        <CreateLeagueForm />
    </Container>
</template>
