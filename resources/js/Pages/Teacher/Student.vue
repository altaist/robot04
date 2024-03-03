<template>
    <Head title="Ученик" />

    <Layout title="Ученик" @fab:click="onFabClick" :fab="true">
        <template v-slot:title>
            <div class="q-ml-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" class="text-white" />
                    <q-breadcrumbs-el :label="'Ученик'" />
                </q-breadcrumbs>
            </div>
        </template>

        <template v-slot:page>
            <div>
                <q-card class="my-card" flat bordered>
                    <q-card-section>
                        <div class="text-overline text-orange-9" v-if="false">Новый ученик</div>
                        <div class="text-h5 q-mt-sm q-mb-xs" @click="dialogStudentFormEdit = true">
                            {{ studentEditable.first_name || studentEditable.name }}
                        </div>
                        <div class="text-caption">
                            {{ studentEditable.first_name }} {{ studentEditable.last_name }}
                        </div>
                    </q-card-section>

                    <q-card-actions>
                        <q-tabs v-model="tab" dense class="text-grey" active-color="primary" indicator-color="primary" align="justify" narrow-indicator>
                            <q-tab name="courses" label="Группы" />
                            <q-tab name="lessons" label="Занятия" />
                            <q-tab name="payments" label="Оплаты" />
                        </q-tabs>
                        <q-space />

                        <q-btn color="grey" round flat dense :icon="expanded
                            ? 'keyboard_arrow_up'
                            : 'keyboard_arrow_down'
                            " @click="expanded = !expanded" />
                    </q-card-actions>

                    <q-slide-transition>
                        <div v-show="expanded">
                            <q-card-section class="text-subtitle2">
                                {{ studentEditable.comment }}
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
                <q-tab-panel name="courses" class="q-pa-none">
                    <div class="q-mt-md">
                        <CourseList :items="courses"/>
                    </div>
                </q-tab-panel>
                <q-tab-panel name="lessons" class="q-pa-none">
                    <div class="q-mt-md">
                        <LessonList :items="lessons"/>
                    </div>
                </q-tab-panel>
                <q-tab-panel name="payments" class="q-pa-none">
                    <div class="q-mt-md">
                        <ListDefault title="Платежи" :items="payments" item-title-field="title" item-sub-title-field="date_start" />
                    </div>
                </q-tab-panel>
            </q-tab-panels>


            <q-dialog v-model="showEditForm">
                <q-card style="width: 100%" class="q-pb-md">
                    <StudentEditForm :formData="formData" @form:saved="onSaved" @form:canceled="onCanceled" />
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
import { useStudents } from '@composables/students.js'
import { useUi } from '@composables/ui.js'
import { f_date, f_schedule } from '@shared/utils.js'

import Layout from "@/Layouts/QuasarLayoutDefault.vue";
import LessonEditForm from "@/Components/Edu/Lesson/LessonEditForm.vue";
import StudentEditForm from "@/Components/Edu/StudentEditForm.vue";
import ListDefault from "@/Components/Edu/ListDefault.vue"
import CourseList from "@/Components/Edu/Course/CourseList.vue"
import LessonList from "@/Components/Edu/Lesson/LessonList.vue"

const page = usePage();
const student = page.props.data;
console.log(page.props.data, student);
const courses = ref(student.courses);
const lessons = ref(student.lessons);
const payments = ref([]);

const studentEditable = ref({
    id: student.id,
    name: student.name,
    first_name: student.first_name,
    last_name: student.last_name,

    comment: student.comment,
    date_start: student.date_start
});

const {
    tab,
    expanded,
    headerExpanded,
    showEditForm,
    loading,
    showLoading
} = useUi();
tab.value = "courses";

const onFabClick = () => { };

</script>
