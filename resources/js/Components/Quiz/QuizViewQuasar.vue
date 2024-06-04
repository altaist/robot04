<template>
    <div class="q-pa-lg">
        <QuizView :quiz="quiz">
            <template #header="{ quiz, quizManager, onQuizHome }">
                <div class="q-pa-md q-mb-lg fixed-top bg-white shadow-1">
                    <div class="row q-col-gutter-md">
                        <div class="col-6">
                            <q-btn @click="onQuizHome" icon="arrow_back"></q-btn>
                        </div>
                        <div class="col-6 text-right">
                            <b>{{ quizManager.getCurrentQuestionIndex() + 1 }}</b> / {{ quizManager.getTotalQuestionsNum() }}
                        </div>
                    </div>
                </div>
            </template>

            <template #start="{ quiz, onQuizStart }">
                <div class="q-my-lg text-h3">
                    Вы готовы ответить на вопросы?
                </div>
                <div class="text-h5">
                    {{ quiz.title }}
                </div>
                <div class="q-my-lg">
                    <q-btn label="Начать" @click="onQuizStart"></q-btn>
                </div>
            </template>
            <template #questions="{ quiz, question, onQuestionCompleted }">
                <div class="q-mt-xl">
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
