<template>
    <Head title="Группы" />

    <Layout title="Личный кабинет учителя" top-menu-icon="menu" top-menu-action="home" @fab:click="onFabClick">
        <template v-slot:title>
            <div class="q-ml-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el :label="'Личный кабинет учителя'" />
                </q-breadcrumbs>
            </div>
        </template>
        <template v-slot:page>
            <div class="q-px-sm">
                <div class="row q-col-gutter-sm">
                    <div class="col-12" v-for="item in courses">
                        <course-card :item="item" :href="route('teacher.course', item.id)"></course-card>
                    </div>
                </div>
            </div>

            <div v-if="false">
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
            </div>
        </template>

    </Layout>
</template>

<script setup>
import { ref, computed, reactive } from 'vue'
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { f_date, f_schedule } from '@shared/utils.js'
import Layout from "@/Layouts/QuasarLayoutDefault.vue";
import CourseCard from "@/Components/Edu/Course/CourseCard.vue";

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
@/shared/utils.js
