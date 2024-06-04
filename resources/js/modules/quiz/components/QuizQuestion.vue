<template>
    <div>
        <slot name="content" :content="questionContent"></slot>
        <slot name="answers" :variants="variants" :setAnswer="setAnswer"></slot>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    question: {
        type: Object,
    },
});


const emit = defineEmits(['question:completed', 'question:canceled'])

const questionContent = computed(() => {
    return props.question.txt
});

const variants = computed(() => {
    return props.question.vs
});

const setAnswer = (answer) => {
    console.log(answer);
    emit('question:completed', answer);
};

</script>
