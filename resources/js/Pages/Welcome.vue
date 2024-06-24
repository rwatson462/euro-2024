<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import {computed} from "vue";
import {PageProps} from "@/types";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Container from "@/Components/Container.vue";
import Footer from "@/Components/Footer.vue";
import NavLink from "@/Components/NavLink.vue";
import {Fixture, League, LeagueTableRecord} from "@/types/app";
import {formatDate} from "@/helpers/date";
import {awayTeam, homeTeam} from "@/helpers/fixtures";

const props = defineProps<PageProps<{
    leagueTables: LeagueTableRecord[];
    leagues: League[];
}>>()

const tables = computed(() => props.leagueTables.reduce(
    (acc, row) => {
        if (!acc[row.league.name]) {
            acc[row.league.name] = []
        }
        acc[row.league.name].push(row)
        return acc
    }, {} as Record<string, LeagueTableRecord[]>
))

function finalScore(fixture: Fixture): string {
    if (!fixture.results || fixture.results.length === 0) {
        return ''
    }
    return `${fixture.results[0].goals_scored} - ${fixture.results[0].goals_conceded}`
}

const isLoggedIn = computed(() => !! props.auth.user)

</script>

<template>
    <Head title="Welcome"/>

    <GuestLayout>
        <Container title="Group Standings">
            <div v-for="(league,key) of leagues" :key="key" class="space-y-4 py-2">
                <h3 class="text-2xl font-semibold">{{ league.name }}</h3>
                <table class="w-full">
                    <thead>
                    <tr>
                        <th class="text-left border-r border-r-slate-300 dark:border-r-slate-600">Team</th>
                        <th class="text-center w-20"><abbr title="Games played">P</abbr></th>
                        <th class="text-center w-20"><abbr title="Wins">W</abbr></th>
                        <th class="text-center w-20"><abbr title="Draws">D</abbr></th>
                        <th class="text-center w-20"><abbr title="Losses">L</abbr></th>
                        <th class="text-center w-20"><abbr title="Goal difference">GD</abbr></th>
                        <th class="text-center w-20 max-md:hidden"><abbr title="Goals scored (for)">F</abbr></th>
                        <th class="text-center w-20 max-md:hidden"><abbr title="Goals conceded (against)">A</abbr></th>
                        <th class="text-center w-20"><abbr title="Points">Pts</abbr></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(row,key) of tables[league.name]" :key="key" class="hover:dark:bg-slate-700 hover:bg-slate-100 border-b border-b-slate-300 dark:border-b-slate-600">
                            <td class="text-left border-r border-r-slate-300 dark:border-r-slate-600">{{ row.team.name }}</td>
                            <td class="text-center">{{ row.played }}</td>
                            <td class="text-center">{{ row.won  }}</td>
                            <td class="text-center">{{ row.drawn }}</td>
                            <td class="text-center">{{ row.lost }}</td>
                            <td class="text-center">{{ row.goal_difference }}</td>
                            <td class="text-center max-md:hidden">{{ row.goals_for }}</td>
                            <td class="text-center max-md:hidden">{{ row.goals_against }}</td>
                            <td class="text-center">{{ row.points }}</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="text-lg font-bold">Fixtures</h4>

                <table class="w-full table-fixed">
                    <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th>Home team</th>
                        <th>Score</th>
                        <th>Away team</th>
                    </tr>
                    </thead>
                    <tbody v-for="(fixture, key) of league.fixtures" key=":key">
                    <tr>
                        <td>{{ formatDate(fixture.kickoff_time) }}</td>
                        <td class="text-center">{{ homeTeam(fixture).name }}</td>
                        <td class="text-center">{{ finalScore(fixture) }}</td>
                        <td class="text-center">{{ awayTeam(fixture).name }}</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </Container>

        <Footer>
            <NavLink href="/dashboard" class="text-sm text-gray-600" v-if="isLoggedIn">Dashboard</NavLink>
            <NavLink href="/login" class="text-sm text-gray-600" v-else>Login</NavLink>
        </Footer>
    </GuestLayout>
</template>
