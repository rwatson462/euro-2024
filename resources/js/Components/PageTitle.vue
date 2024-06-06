<script setup lang="ts">
defineProps<{
    title: string,
}>()
</script>

<template>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ title }}</h2>
</template>
