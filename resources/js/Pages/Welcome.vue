<script setup lang="ts">
import {Head, Link} from '@inertiajs/vue3';
import {computed} from "vue";
import {PageProps} from "@/types";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Container from "@/Components/Container.vue";
import {LeagueTableRecord} from "@/types/app";

const props = defineProps<PageProps<{
    leagueTables: LeagueTableRecord[];
}>>()

const loggedIn = computed(() => !!props.auth.user)

const groups = computed(() => props.leagueTables.reduce(
        (acc, row) => {
            if (!acc.includes(row.league.name)) {
                acc.push(row.league.name)
            }
            return acc
        }, [] as string[])
)

const tables = computed(() => props.leagueTables.reduce(
        (acc, row) => {
            if (!acc[row.league.name]) {
                acc[row.league.name] = []
            }
            acc[row.league.name].push(row)
            return acc
        }, {} as Record<string, LeagueTableRecord[]>
))

</script>

<template>
    <Head title="Welcome"/>

    <GuestLayout>
        <Container title="Group Standings">
            <p>
                Euro 2024 Group Standings
            </p>

            <div v-for="(group,key) of groups" :key="key">
                <h3 class="text-xl font-semibold">{{ group }}</h3>
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="text-left border-r border-r-slate-700">Team</th>
                        <th class="text-center w-20"><abbr title="Games played">P</abbr></th>
                        <th class="text-center w-20"><abbr title="Wins">W</abbr></th>
                        <th class="text-center w-20"><abbr title="Draws">D</abbr></th>
                        <th class="text-center w-20"><abbr title="Losses">L</abbr></th>
                        <th class="text-center w-20"><abbr title="Goal difference">GD</abbr></th>
                        <th class="text-center w-20"><abbr title="Goals scored (for)">F</abbr></th>
                        <th class="text-center w-20"><abbr title="Goals conceded (against)">A</abbr></th>
                        <th class="text-center w-20"><abbr title="Points">Pts</abbr></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row,key) of tables[group]" :key="key" class="hover:dark:bg-slate-700 hover:bg-slate-100 border-b border-b-slate-700">
                            <td class="text-left border-r border-r-slate-700">{{ row.team.name }}</td>
                            <td class="text-center">{{ row.played }}</td>
                            <td class="text-center">{{ row.won  }}</td>
                            <td class="text-center">{{ row.drawn }}</td>
                            <td class="text-center">{{ row.lost }}</td>
                            <td class="text-center">{{ row.goal_difference }}</td>
                            <td class="text-center">{{ row.goals_for }}</td>
                            <td class="text-center">{{ row.goals_against }}</td>
                            <td class="text-center">{{ row.points }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </Container>
    </GuestLayout>
</template>
