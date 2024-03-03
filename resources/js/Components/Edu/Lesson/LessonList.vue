<template>
    <q-list bordered separator v-if="items.length">
        <template v-for="item in items">
            <LessonListItem :item="item"/>
        </template>
    </q-list>
</template>

<script setup>
import { ref } from 'vue'
import { f_date, f_schedule } from '@shared/utils.js'
import LessonListItem from './LessonListItem.vue';

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
