<template>
    <q-card class="my-card " rounded>
        <q-card-section horizontal @click="emit('click:edit')">
            <q-card-section class="col-10 flex-left">
                <div class="text-h5 text-deep-orange q-mt-sm q-mb-xs">
                    {{ getLessonTitle(item) }} <q-btn flat icon="edit" color="black" size="sm" @click="emit('click:edit')" />
                </div>
                <div class="text-caption">
                    Дата: {{ f_date(item.date_start) }}
                </div>
            </q-card-section>

        </q-card-section>
        <q-separator />
        <q-card-actions class="q-mb-sm">
            <div>
                <q-tabs v-model="tabsModel" dense class="text-grey" active-color="primary" indicator-color="primary" narrow-indicator>
                    <q-tab name="students" label="Ученики" />
                    <q-tab name="skills" label="Темы" />
                    <q-tab name="tasks" label="Задания" />
                </q-tabs>
            </div>
        </q-card-actions>
    </q-card>
</template>

<script setup>
import { ref, toRefs } from 'vue'
import { useUi } from '@composables/ui.js'
import { f_date } from '@shared/utils.js'
import { useLesson } from '@composables/lesson.js'

const props = defineProps({
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

const {
    getLessonTitle
} = useLesson();


const emit = defineEmits(['click:edit', 'click:expand'])

//const { tabsModel } = useUi();
const tabsModel = defineModel();
</script>
