<template>
    <q-card class="my-card " rounded>
        <q-card-section horizontal>
            <q-card-section class="col-10 flex-left">
                <!--div class="text-overline text-orange-9" v-if="false">Важный статус</div-->
                <div class="text-h5 q-mt-sm q-mb-xs text-primary">
                    {{ item.first_name || item.name }}
                </div>
                <div class="text-subtitle2">
                    {{ item.first_name }} {{ item.last_name }}
                </div>
            </q-card-section>
            <!--q-card-section class="col-2 flex flex-top flex-center">
                <q-btn flat icon="account_circle" size="lg" color="deep-orange"/>
            </q-card-section-->
            <q-card-section class="col-2 flex flex-top flex-center">
                <q-btn flat icon="edit" color="secondary" @click="emit('click:edit')" />
            </q-card-section>
        </q-card-section>
        <q-separator />
        <q-card-actions class="q-mb-sm">
            <div>
                <q-tabs v-model="tabsModel" dense class="text-black" active-color="primary" indicator-color="primary" align="justify" narrow-indicator>
                    <q-tab name="courses" label="Группы" />
                    <q-tab name="lessons" label="Занятия" />
                    <q-tab name="payments" label="Оплаты" />
                </q-tabs>
            </div>
        </q-card-actions>

    </q-card>
</template>

<script setup>
import { ref, toRefs } from 'vue'
import { useUi } from '@composables/ui.js'

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

const emit = defineEmits(['click:edit', 'click:expand'])

//const { item } = toRefs(props);
const { tabsModel } = useUi();
</script>
