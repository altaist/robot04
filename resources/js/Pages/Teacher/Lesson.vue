<template>
    <Head title="Занятия" />

    <Layout title="Занятия" @fab:click="onFabClick">

        <template v-slot:page>
            <div class="q-my-md">
                <q-breadcrumbs>
                    <q-breadcrumbs-el label="Учитель" :href="route('teacher.home')" />
                    <q-breadcrumbs-el :label="'Группа ' +lesson.course.title" :href="route('teacher.course', lesson.course.id)" />
                    <q-breadcrumbs-el :label="lesson.title || 'Занятие ' + date.formatDate(lesson.created_at, 'DD.MM')" />
                </q-breadcrumbs>
            </div>
            <div class="q-my-lg">
                <!--div><a :href="'/teacher/course/'+lesson.course.id">{{ lesson.course.title }}</a><br/></div-->
                <div class="text-h4">Ученики</div>
            </div>
            <div>
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

            <div>
                <h4>Не записанные:</h4>
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
        </template>

    </Layout>
</template>

<script setup>
import { ref, computed } from 'vue'
import { date } from 'quasar'
import { usePage, Head } from "@inertiajs/vue3";

import Layout from "@/Layouts/QuasarLayoutDefault.vue";

const page = usePage();

const lesson = page.props.data;
const courseStudents = ref(lesson.courseStudents);
const lessonStudents = ref(lesson.students);
console.log(page.props.data);
const studentIdsComputed = computed(() => lessonStudents.value.map((item) => item.id));
const courseStudentIdsComputed = computed(() => courseStudents.value.map((item) => item.id));

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

const onFabClick = (arg) => {
    console.log('click');
}

const onToggle = (val) => {
    console.log(val);
    loading.value = true;
    setTimeout(()=> {showLoading.value = loading.value}, 100);

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
    }).catch(()=> {
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
