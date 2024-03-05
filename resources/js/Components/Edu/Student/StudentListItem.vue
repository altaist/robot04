<template>
    <q-item v-ripple class="q-pa-md" :href="route('teacher.student', item.id)">
        <q-item-section>
            <q-item-label>{{ item.name }}</q-item-label>
            <q-item-label caption>{{ item.first_name }}
                {{ item.last_name }}</q-item-label>
        </q-item-section>
        <q-item-section side top v-if="attachedItems">
            <q-toggle color="secondary" v-model="attachedItems" :val="item.id" />
        </q-item-section>
    </q-item>
    <!--q-inner-loading :showing="showLoading">
        <q-spinner-gears size="50px" color="primary" />
    </q-inner-loading-->
</template>

<script setup>
import { ref, toRefs } from 'vue'
import { f_date, f_schedule } from '@shared/utils.js'

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    item: {
        type: Object
    },


});


const isUserEditable = true;

const { attachedStudents } = toRefs(props);

const attachedItems = defineModel();

const onToggle = () => { console.log('attached')};
</script>
