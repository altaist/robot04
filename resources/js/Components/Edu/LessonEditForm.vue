<template>
    <q-card style="width: 100%" class=" q-pb-md">
        <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-sm">
            <q-card-section class="text-h5">
                {{ formData.id ? 'Изменить' : 'Добавить' }}
            </q-card-section>
            <q-card-section>
                <div style="max-width: 600px">
                    <q-input filled v-model="formData.date_start" label="Дата и время урока">
                        <template v-slot:prepend>
                            <q-icon name="event" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-date v-model="formData.date_start" mask="YYYY-MM-DD HH:mm">
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-date>
                                </q-popup-proxy>
                            </q-icon>
                        </template>

                        <template v-slot:append>
                            <q-icon name="access_time" class="cursor-pointer">
                                <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                                    <q-time v-model="formData.date_start" mask="YYYY-MM-DD HH:mm" format24h>
                                        <div class="row items-center justify-end">
                                            <q-btn v-close-popup label="Close" color="primary" flat />
                                        </div>
                                    </q-time>
                                </q-popup-proxy>
                            </q-icon>
                        </template>
                    </q-input>
                </div>
                <div class="q-mt-md">
                    <q-input filled v-model="formData.title" label="Название урока" />
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
    return formData.id ? route('lesson.update', formData.id) : route('lesson.store');
}

const onReset = () => emit('form:canceled');

</script>
