<template>
        <QuizResults :quiz="quiz" :results="results">
            <template #header="{params}">
                <div class="text-h4 q-my-md">Результаты прохождения теста</div>
            </template>

            <template #results="{results, handlerClose, handlerRepeat}">
                <div class="q-my-xl text-center text-positive text-h5" v-if="results.isSuccess">
                    Тест пройден! :)
                </div>
                <div class="q-my-xl text-center text-negative text-h5" v-else>
                    Тест не пройден (:
                </div>
                <div class="q-my-xl q-pa-lg shadow-2">
                    <div class="row">
                        <div class="col-6">Всего вопросов:</div>
                        <div class="col-6 text-right">{{ results.total }}</div>
                        <div class="col-6 text-positive">Правильные:</div>
                        <div class="col-6 text-right text-positive">{{ results.passed }}</div>
                        <div class="col-6 text-negative">Ошибки:</div>
                        <div class="col-6 text-right text-negative">{{ results.wrong }}</div>
                        <div class="col-6">Пропущено:</div>
                        <div class="col-6 text-right">{{ results.skipped }}</div>
                    </div>
                </div>
                <div class="q-mt-xl q-pa-sm fixed-bottom bg-white">
                    <div class="row q-col-gutter-md">
                        <div class="col-6">
                            <q-btn label="Повторить" icon="repeat" @click="handlerRepeat" class="full-width"></q-btn>
                        </div>
                        <div class="col-6">
                            <q-btn label="Завершить" icon="stop" @click="handlerClose" class="full-width"></q-btn>
                        </div>
                    </div>
                </div>
            </template>
        </QuizResults>
</template>

<script setup>
import QuizResults from '@/modules/quiz/components/QuizResults.vue';

const props = defineProps({
    quiz: {
        type: Object,
    },
    results: {
        type: Object,
    },
});

</script>
