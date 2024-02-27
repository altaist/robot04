<template>
    <Head title="Занятия" />

    <Layout title="Занятия" @fab:click="onFabClick">
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
            <!--div class="q-my-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" />
                    <q-breadcrumbs-el :label="'Группа ' + lesson.course.title" :href="route('teacher.course', lesson.course.id)" />
                    <q-breadcrumbs-el :label="getLessonTitle(lesson)" />
                </q-breadcrumbs>
            </div-->

            <div>
                <q-card class="my-card" flat bordered>
                    <q-card-section>
                        <!--div class="text-overline text-orange-9">Overline</div-->
                        <div class="text-h5 q-mt-sm q-mb-xs" @click="openEditForm">{{ getLessonTitle(lessonEditable) }}</div>
                        <div class="text-caption">
                            Дата: {{ f_date(lessonEditable.date_start) }}
                        </div>
                    </q-card-section>

                    <q-card-actions>
                        <q-tabs v-model="tab" dense class="text-grey" active-color="primary" indicator-color="primary" narrow-indicator>
                            <q-tab name="students" label="Ученики" />
                            <q-tab name="skils" label="Темы" />
                            <q-tab name="tasks" label="Задания" />
                        </q-tabs>
                        <q-space />

                        <q-btn color="grey" round flat dense :icon="expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'" @click="expanded = !expanded" />

                    </q-card-actions>

                    <q-slide-transition>
                        <div v-show="expanded">

                            <q-card-section class="text-subtitle2">
                                {{ lessonEditable.comment }}
                            </q-card-section>
                            <q-separator />
                            <q-card-actions>
                                <q-btn flat color="primary" label="Фото" />
                                <q-btn flat color="secondary" label="Заметки" />

                                <q-space />
                            </q-card-actions>
                        </div>
                    </q-slide-transition>
                </q-card>

            </div>


            <q-separator />

            <q-tab-panels v-model="tab" animated>
                <q-tab-panel name="students" class="q-pa-none">
                    <div class="q-my-md">
                        <!--div><a :href="'/teacher/course/'+lesson.course.id">{{ lesson.course.title }}</a><br/></div-->
                        <!--div class="text-h4">Ученики</div-->
                    </div>
                    <div class="q-mt-md">
                        <q-list bordered separator>
                            <q-item v-for="item in courseStudents" v-ripple>
                                <q-item-section>
                                    <q-item-label>{{ item.name }}</q-item-label>
                                    <q-item-label caption>{{ item.first_name }} {{ item.last_name }}</q-item-label>
                                </q-item-section>
                                <q-item-section side top>
                                    <q-toggle color="orange" v-model="attachedStudents" :val="item.id" @update:model-value="onToggle" />
                                </q-item-section>
                            </q-item>
                            <q-inner-loading :showing="showLoading">
                                <q-spinner-gears size="50px" color="primary" />
                            </q-inner-loading>
                        </q-list>
                    </div>
                    <div class="q-my-md" v-if="nonCourseStudents.length">
                        <div class="q-pa-md">Не записанные:</div>
                        <q-list bordered separator>
                            <q-item v-for="item in nonCourseStudents" v-ripple>
                                <q-item-section>
                                    <q-item-label>{{ item.name }}</q-item-label>
                                    <q-item-label caption>{{ item.first_name }} {{ item.last_name }}</q-item-label>
                                </q-item-section>
                                <q-item-section side top>
                                    <q-toggle color="orange" v-model="attachedStudents" :val="item.id" @update:model-value="onToggle" />
                                </q-item-section>
                            </q-item>
                            <q-inner-loading :showing="showLoading">
                                <q-spinner-gears size="50px" color="primary" />
                            </q-inner-loading>
                        </q-list>
                    </div>
                </q-tab-panel>

                <q-tab-panel name="skils">
                    <div class="text-h6">Темы</div>
                </q-tab-panel>
                <q-tab-panel name="tasks">
                    <div class="text-h6">Задания</div>
                </q-tab-panel>

            </q-tab-panels>



            <q-dialog v-model="showEditForm">
                <q-card style="width: 100%" class=" q-pb-md">
                    <LessonEditForm :formData="lessonEditable" @form:saved="onLessonCanceled" @form:canceled="onLessonCanceled"></LessonEditForm>

                </q-card>
            </q-dialog>
        </template>

    </Layout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { date } from 'quasar'
import { usePage, Head } from "@inertiajs/vue3";
import { f_date } from '@/libs/utils.js'
import { useLesson } from './lesson.js'

import LessonEditForm from "@/Components/Edu/Lesson/LessonEditForm.vue";
import Layout from "@/Layouts/QuasarLayoutDefault.vue";

const {
    getLessonTitle
} = useLesson();

const page = usePage();

const lesson = page.props.data;
const lessonEditable = ref({
    id: lesson.id,
    course_id: lesson.id,
    teacher_id: lesson.teacher_id,
    title: lesson.title,
    comment: lesson.comment,
    date_start: lesson.date_start
});

const courseStudents = ref(lesson.courseStudents);
const lessonStudents = ref(lesson.students);
console.log(page.props.data);
const studentIdsComputed = computed(() => lessonStudents.value.map((item) => item.id));
const courseStudentIdsComputed = computed(() => courseStudents.value.map((item) => item.id));

const tab = ref('students');
const expanded = ref(false);

const isStudentAttached = (id) => {
    return studentIdsComputed.value.includes(id);
}

const isItemInCourse = (id) => {
    return courseStudentIdsComputed.value.includes(id);
}

const nonCourseStudents = computed(() => lessonStudents.value.filter(item => !isItemInCourse(item.id)))

const attachedStudents = ref(studentIdsComputed.value);

const loading = ref(false);
const showLoading = ref(false);
const showEditForm = ref(false);

const openEditForm = () => showEditForm.value = true;
const onLessonCanceled = () => showEditForm.value = false;
const onLessonSaved = (formData) => {
    dialogFormEdit.value = false;
}


const onFabClick = (arg) => {
    console.log('click');
}

const onToggle = (val) => {
    console.log(val);
    loading.value = true;
    setTimeout(() => { showLoading.value = loading.value }, 100);

    axios.post(
        route(
            'lesson.students.sync',
            {
                lessonId: lesson.id,
            }
        ),
        {
            students: val
        }
    ).then((response) => {
        console.log(response);
        attachedStudents.value = response.data;
        showLoading.value = false;
        loading.value = false;
        console.log('Changed', attachedStudents.value);
    }).catch(() => {
        loading.value = false;
        showLoading.value = false;
    });
}


const columns = [
    {
        name: "pos",
        align: "center",
        label: "#",
        field: (row) => row.id,
        sortable: true,
    },
    {
        name: "lesson",
        align: "center",

        label: "Занятие",
        field: (row) => row.title || "Занятие " + date.formatDate(row.created_at, 'DD.MM'),
        sortable: true,
    }
];
</script>
