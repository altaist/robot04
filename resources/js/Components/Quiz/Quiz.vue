<template>
    {{ questions }}
    <div v-if="showAsList">
        <Question v-for="item in questions" :question="item" @question:completed="onQuestionCompleted" />
    </div>
    <div v-else>
        <Question :question="activeQuestion" v-if="activeQuestion" @question:completed="onQuestionCompleted"/>
    </div>

</template>

<script setup>
import { computed, ref, toRefs } from 'vue'
import { useQuiz } from '@/Composables/quiz'
import Question from './Question.vue'

const props = defineProps({
    visibility: {
        type: Boolean,
    },

    quizData: {
        type: Object,
    },
});

const emit = defineEmits(['quiz:completed', 'quiz:canceled']);

const quizManager = useQuiz(props.quizData);

quizManager.moveQuestionPrev();
quizManager.moveQuestionPrev();

console.log(quizManager.getCurrentQuestion());

const questions = computed(() => {
    return props.quizData.qs
});

const activeQuestion = computed(() => {
    return quizManager.getCurrentQuestion();
});

const showAsList = computed(() => {
    return false
});

const onQuestionCompleted = (question, answer) => {
    if(quizManager.isLastQuestion()){
        return onQuizCompleted();
    } else{
        quizManager.moveQuestionNext();
    }
}

const onQuizCompleted = () => {
    const userAnswers = [[1], [1, 1]];
    const result = quizManager.calculateResult(userAnswers);
    console.log(result);
    return emit('quiz:completed', result);
}

</script>
