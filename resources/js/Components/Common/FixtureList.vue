<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {formatDate} from "@/helpers/date";
import {Fixture} from "@/types/app";
import {awayTeam, homeTeam} from "@/helpers/fixtures";

defineProps<{
    fixtures: Fixture[]
}>()

function finalScore(fixture: Fixture): string {
    if (fixture.results.length === 0) {
        return ''
    }
    return `${fixture.results[0].goals_scored} - ${fixture.results[0].goals_conceded}`
}

</script>

<template>
    <table class="w-full table-fixed">
        <thead>
        <tr>
            <th class="text-left">Group</th>
            <th class="text-left">Kickoff time</th>
            <th class="text-center">Home team</th>
            <th class="text-center">Score</th>
            <th class="text-center">Away team</th>
            <th class="text-right w-32">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr
            v-for="(fixture, index) of fixtures"
            :key="index"
        >
            <td class="text-left">{{ fixture.league.name }}</td>
            <td class="text-left">{{ formatDate(fixture.kickoff_time) }}</td>
            <td class="text-center">{{ homeTeam(fixture).name  }}</td>
            <td class="text-center">{{ finalScore(fixture) }}</td>
            <td class="text-center">{{ awayTeam(fixture).name }}</td>
            <td class="text-right">
                <Link :href="route('results.add', {'fixture_id': fixture.id})" class="text-sky-600 hover:text-gray-600">Add result</Link>
            </td>
        </tr>
        </tbody>
    </table>
</template>
