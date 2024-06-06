<script setup lang="ts">
import Container from "@/Components/Container.vue";
import {Fixture} from "@/types/app";
import FixtureList from "@/Components/Common/FixtureList.vue";
import {computed} from "vue";

const { fixtures } = defineProps<{
    fixtures: Fixture[],
}>()

const sortedFixtures = computed(() => fixtures.sort((a,b) => a.kickoff_time.localeCompare(b.kickoff_time)))
</script>

<template>
    <Container :title="`Fixtures (${fixtures.length})`">
        <FixtureList :fixtures="sortedFixtures"/>
    </Container>
</template>
