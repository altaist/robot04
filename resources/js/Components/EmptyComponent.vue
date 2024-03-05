<template>
</template>

<script setup>
import { ref, toRefs } from 'vue'

defineProps({
    visibility: {
        type: Boolean,
    },
    item: {
        type: Object,
    },
    items: {
        type: Array,
    },
    title: {
        type: String,
        default: ''
    },
});

const emit = defineEmits(['form:submitted', 'form:canceled'])

</script>
