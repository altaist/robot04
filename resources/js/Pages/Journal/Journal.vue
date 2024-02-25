<template>
    <Head title="Journal" />

    <Layout title="Журнал" @fab:click="onFabClick">

        <template v-slot:page>
            <h4>Журнал активности</h4>

            <div>

                <q-table title="Последние регистрации" :rows="journal" :columns="columns" :pagination="{ rowsPerPage: 50 }" row-key="name" style="font-size: 20px">
                    <template v-slot:header-cell="props">
                        <q-th :props="props" style="font-size: large">
                            {{ props.col.label }}
                        </q-th>
                    </template>
                </q-table>

            </div>
        </template>

    </Layout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/QuasarLayoutDefault.vue";
import { date } from 'quasar'

const page = usePage();
console.log(page.props.data);
const journal = page.props.data;
let currentTitle = "";

const updateSectionTitle = (title) => {
    currentTitle = title;
    return true;
};

const onFabClick = (arg) => {
    console.log('click');
}

const columns = [
    {
        name: "Course",
        align: "center",
        label: "Группа",
        field: (row) => row.journalable.title || (row.journalable_type == 'lesson' ? "Занятие " + date.formatDate(row.journalable.created_at, 'DD.MM') : "-"),
        sortable: true,
    },
    {
        name: "user",
        required: true,
        label: "Ученик",
        align: "left",
        field: (row) => row.user.name,
        format: (val) => `${val}`,
        sortable: true,
    },
    {
        name: "user",
        required: true,
        label: "Дата",
        align: "left",
        field: (row) => row.created_at,
        format: (val) => `${date.formatDate(val, 'DD-MM-YYYY HH:mm:ss')}`,
        sortable: true,
    }, {
        name: "user",
        required: true,
        label: "Дата",
        align: "left",
        field: (row) => row.created_at,
        format: (val) => `${date.formatDate(val, 'DD-MM-YYYY HH:mm:ss')}`,
        sortable: true,
    },
];
</script>
