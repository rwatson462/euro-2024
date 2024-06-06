<script setup lang="ts">
import {Fixture, Team} from "@/types/app";
import {computed} from "vue";
import AddFixtureForm from "@/Components/League/Forms/AddFixtureForm.vue";
import {Link} from "@inertiajs/vue3";
import Container from "@/Components/Container.vue";
import {formatDate} from "../../helpers/date";

const props = defineProps<{
    leagueId: string,
    fixtures: Fixture[],
    teams: Team[],
}>()

function homeTeam(fixture: Fixture): Team {
    return fixture.teams.find(team => team.pivot.home_or_away === 'home')!
}

function awayTeam(fixture: Fixture): Team {
    return fixture.teams.find(team => team.pivot.home_or_away === 'away')!
}

function finalScore(fixture: Fixture): string {
    if (fixture.results.length === 0) {
        return ''
    }
    return `${fixture.results[0].goals_scored} - ${fixture.results[0].goals_conceded}`
}

const fixtures = computed(() => props.fixtures.sort((a,b) => a.kickoff_time.localeCompare(b.kickoff_time)))
</script>

<template>
    <Container title="Fixtures">
        <table class="w-full table-fixed">
            <thead>
            <tr>
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
        <AddFixtureForm :teams="props.teams"/>
    </Container>
</template>
