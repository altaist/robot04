<template>
    <q-card class="my-card " rounded>
        <q-card-section horizontal>
            <q-card-section class="col-10 flex-left">
                <!--div class="text-overline text-orange-9" v-if="false">Важный статус</div-->
                <div class="text-h5 text-primary q-mt-sm q-mb-xs" >
                    {{ item.title }}
                </div>
                <div class="text-caption">
                    Расписание:
                    {{ f_schedule(item.schedule) }}
                </div>
            </q-card-section>
            <q-card-section class="col-2 flex flex-top flex-center">
                <q-btn flat icon="edit" color="secondary" @click="emit('click:edit')" />
            </q-card-section>

        </q-card-section>
        <q-separator />
        <q-card-actions class="q-mb-sm">
            <div>
                <q-tabs v-model="tabsModel" dense class="text-grey" active-color="primary" indicator-color="primary" narrow-indicator>
                    <q-tab name="lessons" label="Занятия" />
                    <q-tab name="students" label="Ученики" />
                </q-tabs>
            </div>
        </q-card-actions>
    </q-card>
</template>

<script setup>
import { ref, toRefs } from 'vue'
import { useUi } from '@composables/ui.js'
import { f_date, f_schedule } from '@shared/utils.js'

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

//const { item } = toRefs(props);


const emit = defineEmits(['click:edit', 'click:expand'])

//const { tabsModel } = useUi();
const tabsModel = defineModel();
</script>
