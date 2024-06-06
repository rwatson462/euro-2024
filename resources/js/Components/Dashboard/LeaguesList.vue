<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {League} from "@/types/app";

defineProps<{
    leagues: League[],
}>()
</script>

<template>
    <ul class="grid grid-cols-3">
        <li v-for="(league, index) of leagues" :key="index" class="p-2 text-center">
            <Link :href="route('league.view', {'league_id': league.id})" class="text-sky-600 hover:text-gray-600">{{ league.name }}</Link>
        </li>
    </ul>
</template>
