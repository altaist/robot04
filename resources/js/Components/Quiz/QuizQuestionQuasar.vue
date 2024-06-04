<template>
        <QuizQuestion :question="question">
            <template #content="{content}">
                <div class="q-mt-xl"><div class="q-mt-md q-pa-md">{{ content }}</div></div>

            </template>

            <template #answers="{variants, setAnswer}">
                <div class="q-mt-xl q-pa-sm fixed-bottom bg-white">
                    <div class="row q-col-gutter-sm">
                        <div :class="getColClass(variants)" v-for="variant in variants">
                            <q-btn :label="variant.txt" @click="setAnswer(variant)" class="full-width" />
                        </div>
                    </div>
                </div>
            </template>
        </QuizQuestion>
</template>

<script setup>
import QuizQuestion from '@/modules/quiz/components/QuizQuestion.vue';

const props = defineProps({
    question: {
        type: Object,
    },
});

const getColClass = (variants) => {
    let cssClass = 'col-6';

    variants.forEach(element => {
        if (element.txt.length > 100) {
            cssClass = 'col-12';
        }
    });
    return cssClass;
}

</script>
