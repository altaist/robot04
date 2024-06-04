<template>
    <QuizView :quiz="dataJson"></QuizView>
</template>

<script setup>
import { ref, toRefs } from 'vue'
import QuizView from '@/Components/Quiz/QuizViewQuasar.vue';

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

const emit = defineEmits(['question:completed', 'question:canceled']);


const dataJson = {
    title: "Название задания",
    qs: [
        {
            txt: 'Вопрос 1',
            vs: [
                {
                    idx: 0,
                    txt: 'Вариант1',
                },
                {
                    idx: 1,
                    txt: 'Вариант2',
                },
                {
                    idx: 3,
                    txt: 'Вариант3',
                },
                {
                    idx: 4,
                    txt: 'Вариант4',
                },
            ],
            as: [1]
        },
        {
            txt: 'Вопрос 2',
            vs: [
                {
                    idx: 0,
                    txt: 'Вариант1',
                },
                {
                    idx: 1,
                    txt: 'Вариант2',
                },
                {
                    idx: 3,
                    txt: 'Вариант3',
                },
                {
                    idx: 4,
                    txt: 'Вариант4',
                },
            ],
            as: [4, 1]
        },
    ],
    settings: {
        repeat: 0,
        showErrors: false,
        auto: false,
        looping: true,
        onlyForward: false
    }


}



</script>
