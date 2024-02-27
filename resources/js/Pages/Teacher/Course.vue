<template>
    <Head title="Группа" />

    <Layout title="Группа" @fab:click="onFabClick" :fab="true">
        <template v-slot:title>
            <div class="q-ml-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" class="text-white" />
                    <q-breadcrumbs-el :label="'Группа'" />
                </q-breadcrumbs>
            </div>
        </template>

        <template v-slot:page>
            <div>
                <q-card class="my-card" flat bordered>
                    <q-card-section>
                        <!--div class="text-overline text-orange-9">Overline</div-->
                        <div class="text-h5 q-mt-sm q-mb-xs" @click="dialogCourseFormEdit=true">{{ courseEditable.title }}</div>
                        <div class="text-caption text-grey">
                            Расписание: {{ f_schedule(courseEditable.schedule) }}
                        </div>
                    </q-card-section>

                    <q-card-actions>
                        <q-tabs v-model="tab" dense class="text-grey" active-color="primary" indicator-color="primary" align="justify" narrow-indicator>
                            <q-tab name="lessons" label="Занятия" />
                            <q-tab name="students" label="Ученики" />
                        </q-tabs>
                        <q-space />

                        <q-btn color="grey" round flat dense :icon="expanded ? 'keyboard_arrow_up' : 'keyboard_arrow_down'" @click="expanded = !expanded" />

                    </q-card-actions>

                    <q-slide-transition>
                        <div v-show="expanded">

                            <q-card-section class="text-subtitle2">
                                {{ courseEditable.comment }}
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

            <q-tab-panels v-model="tab" animated>
                <q-tab-panel name="lessons">
                    <div class="q-my-md">
                        <!--div><a :href="'/teacher/course/'+lesson.course.id">{{ lesson.course.title }}</a><br/></div-->
                        <!--div class="text-h4">Ученики</div-->
                    </div>
                    <div class="q-mt-md">
                        <q-list bordered separator>
                            <q-item v-for="item in lessons" v-ripple class="q-pa-md" :href="route('teacher.lesson', item.id)">
                                <q-item-section>
                                    <q-item-label>{{ getLessonTitle(item) }} </q-item-label>
                                    <q-item-label caption>{{ item.date_start }}</q-item-label>
                                </q-item-section>

                            </q-item>
                            <q-inner-loading :showing="showLoading">
                                <q-spinner-gears size="50px" color="primary" />
                            </q-inner-loading>
                        </q-list>
                    </div>
                </q-tab-panel>

                <q-tab-panel name="students">
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
                                <q-item-section side top v-if="iSUserEditable">
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


            </q-tab-panels>


            <div v-if="false">
                <q-list bordered separator>
                    <q-item v-for="item in lessons" v-ripple class="q-pa-md" :href="route('teacher.lesson', item.id)">
                        <q-item-section>
                            <q-item-label>{{ getLessonTitle(item) }} </q-item-label>
                            <q-item-label caption>{{ item.date_start }}</q-item-label>
                        </q-item-section>

                    </q-item>
                    <q-inner-loading :showing="showLoading">
                        <q-spinner-gears size="50px" color="primary" />
                    </q-inner-loading>
                </q-list>
            </div>
            <div v-if="false">
                <q-table title="Уроки" :rows="lessons" :columns="columns" :pagination="{ rowsPerPage: 50 }" row-key="id" style="font-size: 20px">
                    <template v-slot:header-cell="props">
                        <q-th :props="props" style="font-size: large">
                            {{ props.col.label }}
                        </q-th>
                    </template>
                    <template v-slot:body="props">
                        <q-tr :props="props" @click="onRowClick(props.row)">
                            <q-td key="lesson" :props="props">

                                <a :href="'/teacher/lesson/' + props.row.id + ''">{{ props.row.title || "Занятие " + date.formatDate(props.row.date_start, 'DD.MM') }}</a>
                            </q-td>

                        </q-tr>
                    </template>
                </q-table>
            </div>
            <q-dialog v-model="dialogFormEdit">
                <q-card style="width: 100%" class=" q-pb-md">
                    <LessonEditForm :formData="newLesson" @form:saved="onLessonSaved" @form:canceled="onLessonCanceled"></LessonEditForm>

                </q-card>
            </q-dialog>

            <q-dialog v-model="dialogCourseFormEdit">
                <q-card style="width: 100%" class=" q-pb-md">
                    <CourseEditForm :formData="courseEditable" @form:saved="onCourseSaved" @form:canceled="onCourseCanceled"></CourseEditForm>

                </q-card>
            </q-dialog>
        </template>


    </Layout>
</template>

<script setup>
import { ref, computed, reactive } from 'vue'
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { date } from 'quasar'
import { getLessonTitle, f_date, f_schedule } from '@/features/common.js'

import Layout from "@/Layouts/QuasarLayoutDefault.vue";
import LessonEditForm from "@/Components/Edu/Lesson/LessonEditForm.vue";
import CourseEditForm from "@/Components/Edu/Course/CourseEditForm.vue";

const page = usePage();
console.log(page.props.data);
const course = ref(page.props.data);
const lessons = ref(course.value.lessons);
const courseStudents = ref(course.value.students);

const loading = ref(false);
const showLoading = ref(false);
const dialogFormEdit = ref(false);
const dialogCourseFormEdit = ref(false);

const tab = ref('lessons');
const expanded = ref(false);

const iSUserEditable = ref(false);

const onFabClick = (arg) => {
    dialogFormEdit.value = true;
    console.log('click');
}

const courseEditable = ref({
    id: course.value.id,
    title: course.value.title,
    schedule: course.value.schedule,
    comment: course.value.comment
});

const newLesson = ref({
    course_id: course.value.id,
    teacher_id: course.value.teacher_id,
    title: "",
    date_start: date.formatDate(Date.now(), 'YYYY-MM-DD HH:mm')
})

const columns = [
    {
        name: "lesson",
        align: "center",
        label: "Занятие",
        field: (row) => row.title || "Занятие " + date.formatDate(row.created_at, 'DD.MM'),
        sortable: true,
    }
];

const onLessonSaved = (formData) => {
    dialogFormEdit.value = false;
    lessons.value.push(formData);
}

const onLessonCanceled = () => dialogFormEdit.value = false;

const onCourseSaved = (formData) => {
    dialogCourseFormEdit.value = false;
}

const onCourseCanceled = () => dialogCourseFormEdit.value = false;
</script>
