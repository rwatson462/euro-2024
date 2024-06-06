<script setup lang="ts">
import {League} from "@/types/app";
import Container from "@/Components/Container.vue";

defineProps<{
    league: League;
}>()
</script>

<template>
    <Container title="League info">
        <div>
            <p>Start date: {{ new Date(league.start_date).toLocaleDateString() }}</p>
            <p>End date: {{ new Date(league.end_date).toLocaleDateString() }}</p>
            <p>Number of teams: {{ league.teams.length }}</p>
        </div>
    </Container>
</template>
