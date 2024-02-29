<template>
    <div class="text-h5 text-bold q-my-md q-ml-md" v-if="title">{{ title }}</div>
    <q-list bordered separator >
        <q-item v-for="item in items" v-ripple clickable @click="onClick(item)">
            <slot name="title_section">
                <q-item-section>
                    <q-item-label>{{ item[itemTitleField] }}</q-item-label>
                    <q-item-label caption>{{ item[itemSubTitleField] }}</q-item-label>
                </q-item-section>
                <q-item-section side top>

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
    itemTitleField: {
        type: String,
        default: ''
    },
    itemSubTitleField: {
        type: String,
        default: ''
    },
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

const emit = defineEmits(['item:click']);
const onClick = (val) => {
    emit('item:click', val)
}

</script>
