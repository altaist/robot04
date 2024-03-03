<template>
    <q-list bordered separator v-if="items.length">
        <template v-for="item in items">
            <CourseListItem :item="item"/>
        </template>
    </q-list>
</template>

<script setup>
import { ref } from 'vue'
import CourseListItem from './CourseListItem.vue';

defineProps({
    isActive: {
        type: Boolean,
    },
    items: {
        type: Array
    },
    title: {
        type: String,
        default: ''
    },
});

</script>
