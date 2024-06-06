<script setup lang="ts">
import {Team} from "@/types/app";

defineProps<{
    teams: Team[]
}>()
</script>

<template>
    <ul class="grid grid-cols-4">
        <li v-for="(team, index) of teams" :key="index" class="text-center">{{ team.name }}</li>
    </ul>
</template>
