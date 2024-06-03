<script setup lang="ts">
import {LeagueTableRecord} from "@/types/app";
import {Link} from "@inertiajs/vue3";

defineProps<{
    leagueId: string;
    table: LeagueTableRecord[];
}>()

</script>

<template>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 font-bold text-2xl">Table</div>
                <div class="p-6">
                    <table class="w-full table-fixed">
                        <thead>
                        <tr>
                            <th class="text-left">Team</th>
                            <th class="text-center">P</th>
                            <th class="text-center">W</th>
                            <th class="text-center">D</th>
                            <th class="text-center">L</th>
                            <th class="text-center">GD</th>
                            <th class="text-center">F</th>
                            <th class="text-center">A</th>
                            <th class="text-right">Pts</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(row, index) of table"
                            :key="index"
                        >
                            <td class="text-left">{{ row.team.name }}</td>
                            <td class="text-center">{{ row.played }}</td>
                            <td class="text-center">{{ row.won  }}</td>
                            <td class="text-center">{{ row.drawn }}</td>
                            <td class="text-center">{{ row.lost }}</td>
                            <td class="text-center">{{ row.goal_difference }}</td>
                            <td class="text-center">{{ row.goals_for }}</td>
                            <td class="text-center">{{ row.goals_against }}</td>
                            <td class="text-right">{{ row.points }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6">
                    <Link :href="route('league.recalculate-table', {'league_id': leagueId})" class="text-sky-600 hover:text-gray-600">Recalculate table</Link>
                </div>
            </div>
        </div>
    </div>
</template>
