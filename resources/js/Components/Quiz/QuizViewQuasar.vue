<template>
    <div class="q-pa-md">
        <QuizView :quiz="quiz">
            <template #header="{ quiz, quizManager, onQuizHome }">
                <div><a href="#" @click.prevent="onQuizHome">Home</a> {{ quizManager.getCurrentQuestionIndex()+1 }} / {{ quizManager.getTotalQuestionsNum() }}</div>
            </template>

            <template #start="{ quiz, onQuizStart }">
                <div class="q-my-lg text-h3">
                    Quiz start page
                </div>
                <div class="text-h5">
                    {{ quiz.title }}
                </div>
                <div class="q-my-lg">
                    <q-btn label="Start quiz" @click="onQuizStart"></q-btn>
                </div>
            </template>
            <template #questions="{ quiz, question, onQuestionCompleted }">
                <div>
                    Quiz questions
                </div>
                <div>
                    <QuizQuestion :question="question" @question:completed="onQuestionCompleted"></QuizQuestion>
                </div>
                <!--div v-if="showAsList">
                <QuizQuestion v-for="item in questions" :question="item" @question:completed="onQuestionCompleted" />
            </div>
            <div v-else>
                <QuizQuestion :question="activeQuestion" v-if="activeQuestion" @question:completed="onQuestionCompleted"/>
            </div-->
            </template>
            <template #results="{ quiz, results, onQuizRepeat, onQuizClose }">
                <QuizResults :results="results" @quiz:repeat="onQuizRepeat" @quiz:close="onQuizClose"></QuizResults>
            </template>
        </QuizView>

    </div>
</template>

<script setup>
import QuizView from '@/modules/quiz/components/QuizView.vue';
import QuizQuestion from './QuizQuestionQuasar.vue';
import QuizResults from './QuizResultsQuasar.vue';

const props = defineProps({
    quiz: {
        type: Object,
    },
});

</script>
