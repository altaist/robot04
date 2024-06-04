<template>
    <div>
        <slot name="header"></slot>
        <slot name="results" :results="results" :isSuccess="isSuccess" :handlerClose="onClose" :handlerRepeat="onRepeat"></slot>
    </div>
</template>

<script setup>
import { ref, toRefs, computed } from 'vue'

const props = defineProps({
    quiz: {
        type: Object,
    },
    results: {
        type: Object,
    },

    isSuccess: {
        type: Boolean,
    },
});


const emit = defineEmits(['quiz:close', 'quiz:repeat'])

const variants = computed(() => {
    return props.question.vs
});

const onClose = () => {
    emit('quiz:close');
};

const onRepeat = () => {
    emit('quiz:repeat');
};

</script>
