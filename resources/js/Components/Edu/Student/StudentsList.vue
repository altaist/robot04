<template>
    <q-list bordered separator v-if="items && items.length">
        <template v-for="item in items">
            <StudentListItem :item="item" v-model="attached"/>
        </template>
    </q-list>
</template>

<script setup>
import { ref } from 'vue'
import StudentListItem from './StudentListItem.vue';

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

const attached = defineModel();

</script>
