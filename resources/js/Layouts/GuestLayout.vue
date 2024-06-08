<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-dvh bg-gray-100 dark:bg-gray-900">
        <div class="w-5xl mx-auto py-6">
            <slot />
        </div>
    </div>
</template>
