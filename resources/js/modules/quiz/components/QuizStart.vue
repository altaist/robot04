<template>
    <div class="q-my-lg text-h3">
        Вы готовы ответить на вопросы?
    </div>
    <div class="text-h5">
        {{ quiz.title }}
    </div>
    <div class="q-my-lg">
        <q-btn label="Начать" @click="onStart"></q-btn>
    </div>
</template>

<script setup>

const props = defineProps({
    quiz: {
        type: Object,
    },
});

const emit = defineEmits(['quiz:start', 'quiz:canceled'])

const onStart = () => {
    console.log('quis start');
    emit('quiz:start');
}

</script>
