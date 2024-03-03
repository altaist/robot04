<template>
    <q-card style="width: 100%" class=" q-pb-md">
        <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-sm">
            <q-card-section class="text-h5">
                {{ formData.id ? 'Изменить' : 'Добавить' }}
            </q-card-section>
            <q-card-section>
                <div >
                    <q-input filled v-model="formData.first_name" label="Имя" />
                </div>
                <div >
                    <q-input filled v-model="formData.last_name" label="Фамилия" />
                </div>

                <div class="q-mt-md">
                    <q-input filled v-model="formData.comment" label="Комментарий" autogrow />
                </div>
            </q-card-section>

            <q-card-section>
                <div class="text-right">
                    <q-btn label="ОК" type="submit" color="primary" :loading="loading" />
                    <q-btn label="Отмена" type="reset" color="primary" flat class="q-ml-sm" />
                </div>
            </q-card-section>

        </q-form>
    </q-card>
</template>
<script setup>
import { ref, toRefs } from 'vue'
import { useUi } from '@composables/ui'
import { useStudents } from '@composables/students'

const props = defineProps({
    title: {
        type: String,
        default: ''
    },
    formData: {
        type: Object,
        default: {}
    },
});

const emit = defineEmits(['form:saved', 'form:canceled'])

const { loading, showLoading, hideLoading } = useUi();

const {
    saveStudent
} = useStudents(useUi);

const { formData } = toRefs(props);
console.log('Student: ', formData.value);
const onSubmit = () => {
    showLoading();
    saveStudent.then((response) => {
        console.log('Saved post result', response.data.data)
        console.log('Saved form data', formData.value)
        emit('form:saved', response.data.data)
    }).catch(
        () => emit('form:canceled')
    ).finally(() => {
        hideLoading();
    });
}

const onReset = () => emit('form:canceled');

</script>
