<template>
    <Head title="Группы" />

    <Layout title="Личный кабинет учителя" @fab:click="onFabClick">

        <template v-slot:page>

            <div>
                <div class="q-my-md">
                    <q-list bordered separator>
                        <q-item v-for="item in courses" v-ripple class="q-pa-md" :href="route('teacher.course', item.id)">
                            <q-item-section>
                                <q-item-label>{{ item.title || "Группа " }} </q-item-label>
                                <q-item-label caption>Учеников: {{ item.students.length }}</q-item-label>
                                <q-item-label caption>{{ f_schedule(item.schedule) }}</q-item-label>
                            </q-item-section>

                        </q-item>
                        <q-inner-loading :showing="showLoading">
                            <q-spinner-gears size="50px" color="primary" />
                        </q-inner-loading>
                    </q-list>
                </div>
                <div v-if="false">
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
                                    <a :href="'/teacher/course/' + props.row.id + ''">{{ props.row.title }}</a>
                                </q-td>
                                <q-td key="teacher" :props="props">
                                   2232323 {{ props.row.teacher.name }}
                                </q-td>
                                <q-td key="schedule" :props="props">
                                    {{ f_schedule(props.row.schedule) }}
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
import { ref, computed, reactive } from 'vue'
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/QuasarLayoutDefault.vue";
import { date } from 'quasar'
import { f_date, f_schedule } from '@/features/common.js'

const page = usePage();
console.log(page.props.data);
const courses = page.props.data;
let currentTitle = "";

const loading = ref(false);
const showLoading = ref(false);
const dialogFormEdit = ref(false);


const onFabClick = (arg) => {
    console.log('click');
}

const showSchedule = val => JSON.stringify(val);

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
        sortable: true,
    }
];
</script>
