<template>
    <q-item class="q-pa-md" :href="route('teacher.lesson', item.id)">
        <q-item-section>
            <q-item-label>{{ getLessonTitle(item) }}
            </q-item-label>
            <q-item-label caption>{{
                item.date_start
            }}</q-item-label>
        </q-item-section>
    </q-item>
</template>

<script setup>
import { ref } from 'vue'
import { useLesson } from '@composables/lesson.js'

defineProps({

    title: {
        type: String,
        default: ''
    },
    item: {
        type: Object
    }
});

const {
    getLessonTitle
} = useLesson();

</script>
