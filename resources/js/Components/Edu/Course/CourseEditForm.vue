<template>
    <q-card style="width: 100%" class=" q-pb-md">
        <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-sm">
            <q-card-section class="text-h5">
                {{ formData.id ? 'Изменить' : 'Добавить' }}
            </q-card-section>
            <q-card-section>

                <div >
                    <q-input filled v-model="formData.title" label="Название" />
                </div>

                <div class="q-mt-md">
                    <q-input filled v-model="formData.comment" label="Комментарий" autogrow />
                </div>
            </q-card-section>
            <!--q-card-section>
                            <q-input v-model="formData.start_date" filled type="date" hint="Дата начала урока" />
                        </q-card-section>

                        <q-card-section>
                            <q-input v-model="formData.start_time" filled type="time" hint="Время начала урока" />
                        </q-card-section-->

            <q-card-section>
                <div class="text-right">
                    <q-btn label="ОК" type="submit" color="primary" />
                    <q-btn label="Отмена" type="reset" color="primary" flat class="q-ml-sm" />
                </div>
            </q-card-section>

        </q-form>
    </q-card>
</template>
<script setup>
import { ref, toRefs } from 'vue'
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    isShort: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    formData: {
        type: Object,
        default: {}
    },
    title: {
        type: String,
        default: ''
    },
});

const emit = defineEmits(['form:saved', 'form:canceled'])

//const user = usePage().props.auth.user;
//const form = useForm(lesson);

const loading = ref(false);
const showLoading = ref(false);

const { formData } = toRefs(props);
console.log('Lesson: ', formData.value);
const onSubmit = () => {

    console.log(formData.value);
    axios.post(
        getSubmitActionRouter(formData.value),
        formData.value
    ).then((response) => {
        console.log('Saved post result', response.data.data)
        console.log('Saved form data', formData.value)
        emit('form:saved', response.data.data)
    }).catch(
        () => emit('form:canceled')
    ).finally(() => {
        loading.value = false;
        showLoading.value = false;
    });
}

const getSubmitActionRouter = (formData) => {
    return formData.id ? route('course.update', formData.id) : route('course.store');
}

const onReset = () => emit('form:canceled');

</script>
