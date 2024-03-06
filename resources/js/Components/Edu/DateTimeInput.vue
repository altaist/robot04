<template>
    <div style="max-width: 600px">
        <q-input filled v-model="dateModel" label="Дата и время урока">
            <template v-slot:prepend>
                <q-icon name="event" class="cursor-pointer">
                    <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-date v-model="dateModel" :mask="mask">
                            <div class="row items-center justify-end">
                                <q-btn v-close-popup label="Закрыть" color="primary" flat />
                            </div>
                        </q-date>
                    </q-popup-proxy>
                </q-icon>
            </template>

            <template v-slot:append>
                <q-icon name="access_time" class="cursor-pointer">
                    <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                        <q-time v-model="dateModel" :mask="mask" format24h>
                            <div class="row items-center justify-end">
                                <q-btn v-close-popup label="Закрыть" color="primary" flat />
                            </div>
                        </q-time>
                    </q-popup-proxy>
                </q-icon>
            </template>
        </q-input>
    </div>
</template>
<script setup>
const props = defineProps({
    label: {
        type: String,
        default: 'Дата и время'
    },
    mask: {
        type: String,
        default: 'YYYY-MM-DD HH:mm'
    }
})

const dateModel = defineModel();

</script>
