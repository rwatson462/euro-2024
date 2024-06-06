<script setup lang="ts">
import {Fixture, Team} from "@/types/app";
import {computed} from "vue";
import AddFixtureForm from "@/Components/League/Forms/AddFixtureForm.vue";
import Container from "@/Components/Container.vue";
import FixtureList from "@/Components/Common/FixtureList.vue";

const { fixtures } = defineProps<{
    leagueId: string,
    fixtures: Fixture[],
    teams: Team[],
}>()

const sortedFixtures = computed(() => fixtures.sort((a,b) => a.kickoff_time.localeCompare(b.kickoff_time)))
</script>

<template>
    <Container title="Fixtures">
        <FixtureList :fixtures="sortedFixtures"/>
        <AddFixtureForm :teams="teams"/>
    </Container>
</template>
