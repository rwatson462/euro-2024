<script setup lang="ts">
import {League} from "@/types/app";

defineProps<{
    league: League;
}>()
</script>

<template>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">League info</div>

                <div class="p-6">
                    <p>Start date: {{ new Date(league.start_date).toLocaleDateString() }}</p>
                    <p>End date: {{ new Date(league.end_date).toLocaleDateString() }}</p>
                    <p>Number of teams: {{ league.teams.length }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
