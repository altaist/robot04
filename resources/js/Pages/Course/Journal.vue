<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { QBtn } from 'quasar';

const page = usePage();
const journal = page.props.journal;
let currentTitle = "";

const updateSectionTitle = (title) => {
    currentTitle = title;
    return true;
}

const columns = [
    { name: 'Course', align: 'center', label: 'Занятие', field: row => row.journalable.title, sortable: true },
    {
        name: 'user',
        required: true,
        label: 'Ученик',
        align: 'left',
        field: row => row.user.name,
        format: val => `${val}`,
        sortable: true
    },
]

</script>

<template>
    <Head title="Journal" />
    <h2>Журнал активности</h2>

    <div v-for="item in journal">
        <div v-if="currentTitle != item.journalable.title && updateSectionTitle(item.journalable.title)">{{ item.journalable.title }}</div>
        <div>{{ item.user.name }}</div>
    </div>
    <q-btn label="dfdfd">xcvcxvc</q-btn>
    <div>
        <div class="q-pa-md">
            <q-table title="Последние регистрации" :rows="journal" :columns="columns" row-key="name" style="font-size: 20px">
                <template v-slot:header-cell="props">
                    <q-th :props="props" style="font-size: large">
                        {{ props.col.label }}
                    </q-th>
                </template>
            </q-table>

        </div>
        <q-fab v-model="fab1" label="Actions" label-position="left" color="purple" icon="keyboard_arrow_right" direction="right">
            <q-fab-action color="primary" @click="onClick" icon="mail" label="Email" />
            <q-fab-action color="secondary" @click="onClick" icon="alarm" label="Alarm" />
        </q-fab>
    </div>
</template>
