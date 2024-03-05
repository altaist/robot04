<template>
    <Head title="Ученик" />

    <Layout title="Ученик">
        <template v-slot:title>
            <div class="q-ml-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" class="text-white" />
                    <q-breadcrumbs-el :label="'Группа '" :href="route('teacher.course', lesson.course.id)" class="text-white" />
                    <q-breadcrumbs-el :label="'Занятие'" class="text-white" />
                </q-breadcrumbs>
            </div>
        </template>

        <template v-slot:page>
            <div class="q-gutter-md">
                <LessonHeader
                    :item="lesson"
                    v-model="tabsModel"
                    @click:edit="visibilityForEditForm = true"
                />

            </div>

            <q-tab-panels v-model="tabsModel" animated>
                <q-tab-panel name="students" class="q-pa-none">
                    <div class="q-mt-md">
                        <StudentsList :items="courseStudents" v-model="attachedStudents" @update:model-value="onToggle" />
                    </div>
                </q-tab-panel>
                <q-tab-panel name="skills" class="q-pa-none">
                    <div class="q-mt-md">

                    </div>
                </q-tab-panel>
                <q-tab-panel name="tasks" class="q-pa-none">
                    <div class="q-mt-md">
                    </div>
                </q-tab-panel>
            </q-tab-panels>
            <LessonEditForm :item="lesson" v-model:visibility="visibilityForEditForm" @form:submitted="onSubmit" @form:canceled="onCanceled" />
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
import ListDefault from "@/Components/Edu/ListDefault.vue"
import CourseList from "@/Components/Edu/Course/CourseList.vue"
import LessonList from "@/Components/Edu/Lesson/LessonList.vue"
import StudentEditForm from "@/Components/Edu/Student/StudentEditForm.vue"
import StudentHeader from "@/Components/Edu/Student/StudentHeader.vue"
import LessonHeader from '@/Components/Edu/Lesson/LessonHeader.vue'
import StudentsList from '@/Components/Edu/Student/StudentsList.vue'
import LessonEditForm from '@/Components/Edu/Lesson/LessonEditForm.vue'

const page = usePage();
const lesson = ref(page.props.data);

const ui = useUi();
const {
    tabsModel,
    loading,
    visibilityForEditForm,
} = ui;

tabsModel.value = "students";

const courseStudents = ref(lesson.value.courseStudents);
const lessonStudents = ref(lesson.value.students);
console.log(page.props.data);

const studentIdsComputed = computed(() => lessonStudents.value.map((item) => item.id));
const courseStudentIdsComputed = computed(() => courseStudents.value.map((item) => item.id));
const isItemInCourse = (id) => {
    return courseStudentIdsComputed.value.includes(id);
}
const attachedStudents = ref(studentIdsComputed.value);
const nonCourseStudents = computed(() => lessonStudents.value.filter(item => !isItemInCourse(item.id)))


const onSubmit = (formData) => {
    lesson.value.title = formData.title;
    lesson.value.date_start = formData.date_start;
    lesson.value.comments = formData.comments;
    console.log('Lesson onSubmit', formData, lesson.value )
    visibilityForEditForm.value = false;
}
const onCanceled = () => visibilityForEditForm.value = false;

const onToggle = (val) => {
    console.log(val);
    loading.value = true;
    axios.post(
        route(
            'lesson.students.sync',
            {
                lessonId: lesson.value.id,
            }
        ),
        {
            students: val
        }
    ).then((response) => {
        console.log(response);
        attachedStudents.value = response.data;
        loading.value = false;
        console.log('Changed', attachedStudents.value);
    }).catch(() => {
        loading.value = false;
    });
}

</script>
