<template>
    <div>
        <div>{{ title }}</div>
        <div>
            <div class="row">
                <div :class="getColClass()" v-for="variant in variants">
                    <q-btn :label="variant.txt" @click="setAnswer(variant)"/>
                </div>
            </div>
        </div>
        {{ variants }}
    </div>
</template>

<script setup>
import { ref, toRefs, computed } from 'vue'

const props = defineProps({
    question: {
        type: Object,
    },
});


const emit = defineEmits(['question:completed', 'question:canceled'])

const title = computed(() => {
    return props.question.title
});

const variants = computed(() => {
    return props.question.vs
});

const getColClass = () => {
    let cssClass = 'col-6';
    console.log(variants.value);
    variants.value.forEach(element => {
        if(element.txt.length > 100) {
            cssClass = 'col-12';
        }
    });
    return cssClass;
}

const setAnswer = (answer) => {
    emit('question:completed', props.question, answer);
};

</script>
