<template>
        <QuizResults :quiz="quiz" :results="results">
            <template #header="{params}">
                <div class="q-text-h4">Результаты прохождения теста</div>
            </template>

            <template #results="{results, handlerClose, handlerRepeat}">
                <div>
                    {{ results }}
                </div>
                <div>
                    <q-btn label="Repeat" @click="handlerRepeat"></q-btn>
                </div>
                <div>
                    <q-btn label="Close" @click="handlerClose"></q-btn>
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
