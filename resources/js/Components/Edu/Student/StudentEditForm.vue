<template>
    <q-dialog v-model="visibility">
        <q-card style="width: 100%" class="q-pb-md">
            <q-card style="width: 100%" class=" q-pb-md">
                <q-form @submit="onSubmit" @reset="emit('form:canceled')" class="q-gutter-sm">
                    <q-card-section class="text-h5">
                        {{ formData.id ? 'Изменить' : 'Добавить' }}
                    </q-card-section>
                    <q-card-section>
                        <div>
                            <q-input filled v-model="formData.first_name" label="Имя" />
                        </div>
                        <div class="q-mt-md">
                            <q-input filled v-model="formData.last_name" label="Фамилия" />
                        </div>

                        <!--div class="q-mt-md">
                            <q-input filled v-model="formData.comment" label="Комментарий" autogrow />
                        </div-->
                    </q-card-section>

                    <q-card-section>
                        <div class="text-right">
                            <q-btn label="ОК" type="submit" color="primary" :loading="loading" />
                            <q-btn label="Отмена" type="reset" color="primary" flat class="q-ml-sm" />
                        </div>
                    </q-card-section>

                </q-form>
            </q-card>
        </q-card>
    </q-dialog>
</template>
<script setup>
import { ref, toRefs } from 'vue'
import { useUi } from '@composables/ui'
import { useStudents } from '@composables/students'

const props = defineProps({
    visibility: {
        type: Boolean,
        default: false
    },

    loading: {
        type: Boolean,
        default: false
    },

    title: {
        type: String,
        default: ''
    },
    item: {
        type: Object,
        default: {}
    },
});
const emit = defineEmits(['form:submitted', 'form:canceled'])

const { item } = props;
const visibility = defineModel('visibility');
const ui = useUi();
const { loading, showLoading, hideLoading } = ui;

const {
    saveStudent
} = useStudents(ui);

let formData = ref({...item});

const onSubmit = () => {
    showLoading();
    saveStudent(formData.value)
        .then((response) => {
            console.log('Saved post result', response.data.data);
            //formData.value = response.data.data;
            emit('form:submitted', response.data.data);
        })
        .catch(
            error => console.log('Error', error)
        )
        .finally(() => {
            hideLoading();
        });
}

const onReset = () => emit('form:canceled');



</script>
