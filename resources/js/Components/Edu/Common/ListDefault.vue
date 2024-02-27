<template>
    <q-list bordered separator>
        <q-item v-for="item in items" v-ripple>
            <slot name="title_section">
                <q-item-section>
                    <q-item-label>{{ item.name }}</q-item-label>
                    <q-item-label caption>{{ item.first_name }} {{ item.last_name }}</q-item-label>
                </q-item-section>
                <q-item-section side top>
                    <q-toggle color="orange" v-model="toggles" :val="item.id" @update:model-value="onToggle" />
                </q-item-section>
            </slot>
        </q-item>
        <q-inner-loading :showing="showLoading">
            <q-spinner size="50px" color="primary" />
        </q-inner-loading>
    </q-list>
</template>

<script setup>
import { ref } from 'vue'

defineProps({
    title: {
        type: String,
        default: ''
    },
    showLoading: {
        type: Boolean,
        default: false
    },
    items: {
        type: Array
    },
});

const onToggle = () => emit('')

</script>
