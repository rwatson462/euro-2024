<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import {computed} from "vue";
import {PageProps} from "@/types";

const props = defineProps<PageProps<{}>>()

const loggedIn = computed(() => !! props.auth.user)

</script>

<template>
    <Head title="Welcome" />
    <Link
        v-if="! loggedIn"
        :href="route('login')"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
    >
        Log in
    </Link>

    <Link
        v-if="! loggedIn"
        :href="route('register')"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
    >
        Sign up
    </Link>

    <Link
        v-if="$page.props.auth.user"
        :href="route('dashboard')"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
    >
        Dashboard
    </Link>
</template>
