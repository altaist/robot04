<template>
    <Head title="Группы" />

    <Layout title="Группы" @fab:click="onFabClick">

        <template v-slot:page>

            <div>
                <div>
                    <q-table title="Мои группы" :rows="courses" :columns="columns" :pagination="{ rowsPerPage: 50 }" row-key="id" style="font-size: 20px">
                        <template v-slot:header-cell="props">
                            <q-th :props="props" style="font-size: large">
                                {{ props.col.label }}
                            </q-th>
                        </template>
                        <template v-slot:body="props">
                            <q-tr :props="props" @click="onRowClick(props.row)">
                                <q-td key="pos" :props="props">
                                    {{ props.row.pos }}
                                </q-td>
                                <q-td key="course" :props="props">
                                    <a :href="'/teacher/course/'+props.row.id+''">{{ props.row.title }}</a>
                                </q-td>
                                <q-td key="teacher" :props="props">
                                    {{ props.row.teacher.name }}
                                </q-td>
                                <q-td key="schedule" :props="props">
                                    {{ props.row.schedule }}
                                </q-td>
                            </q-tr>
                        </template>
                    </q-table>
                </div>
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
const courses = page.props.data;
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
        name: "pos",
        align: "left",
        label: "#",
        field: (row) => row.pos,
        sortable: true,
    },
    {
        name: "course",
        align: "left",
        label: "Группа",
        field: (row) => row.title,
        format: (val) => `<a href=''>${val}</a>`,
        sortable: true,
    },
    {
        name: "teacher",
        required: true,
        label: "Преподаватель",
        align: "left",
        field: (row) => row.teacher.name,
        format: (val) => `${val}`,
        sortable: true,
    },
    {
        name: "schedule",
        required: true,
        label: "Расписание",
        align: "left",
        field: (row) => row.schedule,
        format: (val) => `${JSON.stringify(val)}`,
        sortable: true,
    }
];
</script>
