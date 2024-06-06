<script setup lang="ts">
defineProps<{
    title: string,
}>()
</script>

<template>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                <div class="text-gray-900 dark:text-gray-100 font-bold text-2xl">
                    {{ title }}
                </div>
                <div class="space-y-6">
                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
</template>
