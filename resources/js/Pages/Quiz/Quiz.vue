<template>
    <div class="fit">
        <div v-if="!loading">
            <QuizPage></QuizPage>
        </div>
        <div v-else>
            Quiz loading...
        </div>
    </div>
</template>

<script setup>
import { ref, toRefs } from 'vue'
//import QuizPage from '@/Components/Quiz/QuizViewQuasar.vue';
import QuizPage from '@/modules/quiz/components/QuizPage.vue';
import { useQuizApp } from '@/modules/quiz/composables/quizapp'

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
const loading = ref(false);
const loadQuiz = async () => {
    const quizApp = useQuizApp();
    loading.value = true;
    const quiz = await quizApp.loadQuiz();
    console.log(quiz)
    loading.value = false;
    return quiz;
}

const quizManager = loadQuiz();

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
            txt: 'Сколько десятков в числе 300?',
            vs: [
                {
                    idx: 0,
                    txt: '10',
                },
                {
                    idx: 1,
                    txt: '20',
                },
                {
                    idx: 3,
                    txt: '30',
                },
                {
                    idx: 4,
                    txt: '40',
                },
            ],
            as: [3]
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
