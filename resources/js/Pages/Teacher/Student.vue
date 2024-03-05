<template>
    <Head title="Ученик" />

    <Layout title="Ученик" @fab:click="onFabClick">
        <template v-slot:title>
            <div class="q-ml-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" class="text-white" />
                    <q-breadcrumbs-el :label="'Ученик'" />
                </q-breadcrumbs>
            </div>
        </template>

        <template v-slot:page>
            <div class="q-gutter-md">
                <StudentHeader
                    :item="student"
                    @click:edit="visibilityForEditForm = true"
                />

            </div>

            <q-tab-panels v-model="tabsModel" animated>
                <q-tab-panel name="courses" class="q-pa-none">
                    <div class="q-mt-md">
                        <CourseList :items="courses" />
                    </div>
                </q-tab-panel>
                <q-tab-panel name="lessons" class="q-pa-none">
                    <div class="q-mt-md">
                        <LessonList :items="lessons" />
                    </div>
                </q-tab-panel>
                <q-tab-panel name="payments" class="q-pa-none">
                    <div class="q-mt-md">
                        <ListDefault title="Платежи" :items="payments" item-title-field="title" item-sub-title-field="date_start" />
                    </div>
                </q-tab-panel>
            </q-tab-panels>
            <StudentEditForm :item="student" v-model:visibility="visibilityForEditForm" @form:submitted="onSubmit" @form:canceled="onCanceled" />
        </template>
    </Layout>
</template>
<script setup>

import { ref, toRef, computed, reactive } from 'vue'
import { Head } from "@inertiajs/vue3"
import { usePage } from "@inertiajs/vue3"
import { date } from 'quasar'
import { useStudents } from '@composables/students.js'
import { useUi } from '@composables/ui.js'
import { f_date, f_schedule } from '@shared/utils.js'

import Layout from "@/Layouts/QuasarLayoutDefault.vue"
import LessonEditForm from "@/Components/Edu/Lesson/LessonEditForm.vue"
import ListDefault from "@/Components/Edu/ListDefault.vue"
import CourseList from "@/Components/Edu/Course/CourseList.vue"
import LessonList from "@/Components/Edu/Lesson/LessonList.vue"
import StudentEditForm from "@/Components/Edu/Student/StudentEditForm.vue"
import StudentHeader from "@/Components/Edu/Student/StudentHeader.vue"

const page = usePage();
const student = ref(page.props.data);
console.log(page.props, student.value.courses);
const courses = ref(student.value.courses);
const lessons = ref(student.value.lessons);
const payments = ref([]);

let studentEditable = ref({...student.value});


const ui = useUi();
const {
    tabsModel,
    visibilityForEditForm,
} = ui;

tabsModel.value = "courses";

const onSubmit = (formData) => {
    student.value = formData;
    visibilityForEditForm.value = false;
}
const onCanceled = () => visibilityForEditForm.value = false;
const onFabClick = () => { };

</script>
