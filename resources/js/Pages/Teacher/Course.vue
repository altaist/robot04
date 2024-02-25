<template>
    <Head title="Группа" />

    <Layout title="Группа" @fab:click="onFabClick" :fab="true">

        <template v-slot:page>
            <div class="q-my-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" />
                    <q-breadcrumbs-el label="Группа" />
                </q-breadcrumbs>
            </div>
            <h4>{{ course.title }}</h4>
            <div>
                <q-list bordered separator>
                    <q-item v-for="item in lessons" v-ripple class="q-pa-md" :href="route('teacher.lesson', item.id)">
                        <q-item-section>
                            <q-item-label>{{ item.title || "Занятие " + date.formatDate(item.created_at, 'DD.MM') }} </q-item-label>
                            <q-item-label caption>{{ item.created_at }}</q-item-label>
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

                                <a :href="'/teacher/lesson/' + props.row.id + ''">{{ props.row.title || "Занятие " + date.formatDate(props.row.created_at, 'DD.MM') }}</a>
                            </q-td>

                        </q-tr>
                    </template>
                </q-table>
            </div>
            <q-dialog v-model="dialogFormEdit">
                <slot name="dialog_form_edit" />
                <q-card style="width: 300px" class="q-px-sm q-pb-md">
                    <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
                        <q-card-section>
                            <div class="text-h6">Добавить урок</div>
                        </q-card-section>
                        <q-input filled v-model="newLesson.title" label="Название урока *" hint="Название" lazy-rules
                            :rules="[val => val && val.length > 0 || 'Пожалуйста, введите название']" />


                        <div>
                            <q-btn label="ОК" type="submit" color="primary" />
                            <q-btn label="Отмена" type="reset" color="primary" flat class="q-ml-sm" />
                        </div>
                    </q-form>
                </q-card>
            </q-dialog>
        </template>


    </Layout>
</template>

<script setup>
import { ref, computed, reactive } from 'vue'
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import Layout from "@/Layouts/QuasarLayoutDefault.vue";
import { date } from 'quasar'

const page = usePage();
console.log(page.props.data);
const course = ref(page.props.data);
const lessons = ref(course.value.lessons);

const loading = ref(false);
const showLoading = ref(false);
const dialogFormEdit = ref(false);

const onFabClick = (arg) => {
    dialogFormEdit.value = true;
    console.log('click');
}

const newLesson = ref({
    course_id: course.value.id,
    teacher_id: course.value.teacher_id,
    title: ""
})

const onSubmit = () => {
    console.log(newLesson.value);
    axios.post(
        route(
            'lesson.store',
        ),
        newLesson.value
    ).then((response) => {
        newLesson.value = response.data.data;
        lessons.value.push(newLesson.value);
    }).finally(() => {
        dialogFormEdit.value = false;
        loading.value = false;
        showLoading.value = false;
    });
}

const onReset = () => dialogFormEdit.value = false

const columns = [

    {
        name: "lesson",
        align: "center",
        label: "Занятие",
        field: (row) => row.title || "Занятие " + date.formatDate(row.created_at, 'DD.MM'),
        sortable: true,
    }

];
</script>
