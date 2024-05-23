<template>
    
    <q-card v-ripple class="bg-secondary text-white cursor-pointer q-hoverable" @click="onClick(item)">
        <q-card-section>
            <div class="text-h6">{{ item.title || "Группа " }}</div>
            <div class="text-subtitle2">{{ f_schedule(item.schedule) }}</div>
        </q-card-section>
        <q-card-section>
        </q-card-section>
    </q-card>

    <!--q-item v-ripple class="q-pa-md" :href="route('teacher.course', item.id)">
        <q-item-section>
            <q-item-label>{{ item.title || "Группа " }} </q-item-label>

            <q-item-label caption>{{ f_schedule(item.schedule) }}</q-item-label>
        </q-item-section>
    </q-item-->
</template>

<script setup>
import { f_date, f_schedule } from '@shared/utils.js'

defineProps({

    title: {
        type: String,
        default: ''
    },
    item: {
        type: Object
    }
});

const onClick = (item) => {
    window.location =route('teacher.course', item.id)
}


</script>
