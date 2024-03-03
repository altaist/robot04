<template>
    <q-list bordered separator>
        <template v-for="item in items">
                <q-item v-ripple class="q-pa-md" :href="route('teacher.course', item.id)">
                <q-item-section>
                    <q-item-label>{{ item.title || "Группа " }} </q-item-label>

                    <q-item-label caption>{{ f_schedule(item.schedule) }}</q-item-label>
                </q-item-section>
            </q-item>
        </template>
    </q-list>
</template>

<script setup>
import { ref } from 'vue'
import { f_date, f_schedule } from '@shared/utils.js'

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
