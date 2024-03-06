<template>
    <q-dialog v-model="visibility">

        <q-card style="width: 100%" class=" q-pb-md">
            <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-sm">
                <q-card-section class="text-h5">
                    {{ formData.id ? 'Изменить' : 'Добавить' }}
                </q-card-section>
                <q-card-section>
                    <div style="max-width: 600px">
                        <date-time-input v-model="formData.date_start"/>
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
    </q-dialog>
</template>
<script setup>
import { ref, toRefs } from 'vue'
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { useUi } from '@composables/ui'
import DateTimeInput from '../DateTimeInput.vue';

const props = defineProps({
    isShort: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    item: {
        type: Object,
        default: {}
    },
    title: {
        type: String,
        default: ''
    },
});

const emit = defineEmits(['form:submitted', 'form:canceled'])

//const user = usePage().props.auth.user;
//const form = useForm(lesson);

const { item } = props;
const visibility = defineModel('visibility');
const ui = useUi();
const { loading, showLoading, hideLoading } = ui;

const formData = ref({...item});
console.log('Lesson: ', formData.value);
const onSubmit = () => {
    showLoading()
    console.log(formData.value);
    axios.post(
        getSubmitActionRouter(formData.value),
        formData.value
    ).then((response) => {
        console.log('Saved post result', response.data.data)
        emit('form:submitted', response.data.data);
        visibility.value = false;
    }).catch(
        () => emit('form:canceled')
    ).finally(() => {
        hideLoading();
    });
}

const getSubmitActionRouter = (formData) => {
    return formData.id ? route('lesson.update', formData.id) : route('lesson.store');
}

const onReset = () => emit('form:canceled');

</script>
