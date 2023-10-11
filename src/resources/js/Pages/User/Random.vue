<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const props = defineProps({
    user: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <div>
            Random
            {{ props.user }}
        </div>
    </AuthenticatedLayout>
</template>