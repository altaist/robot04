<template>
    <Head title="Journal" />

    <Layout title="Журнал" @fab:click="onFabClick">
        <template v-slot:page>
            <h4>Журнал активности</h4>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>
            <div v-for="item in journal" class="q-mt-lg">
                <div v-if="currentTitle != item.journalable.title &&
                    updateSectionTitle(item.journalable.title)
                    ">
                    {{ item.journalable.title }}
                </div>
                <div>{{ item.user.name }}</div>
            </div>

            <div>
                <div class="q-pa-md">
                    <q-table title="Последние регистрации" :rows="journal" :columns="columns" row-key="name" style="font-size: 20px">
                        <template v-slot:header-cell="props">
                            <q-th :props="props" style="font-size: large">
                                {{ props.col.label }}
                            </q-th>
                        </template>
                    </q-table>
                </div>
            </div>
        </template>
        <template v-slot:dialog_form_edit>
            <q-card style="width: 300px" class="q-px-sm q-pb-md">
                <q-card-section>
                    <div class="text-h6">Volumes</div>
                </q-card-section>

                <q-item-label header>Media volume</q-item-label>
                <q-item dense>
                    <q-item-section avatar>
                        <q-icon name="volume_up" />
                    </q-item-section>
                    <q-item-section>
                        <q-slider color="teal" v-model="slideVol" :step="0" />
                    </q-item-section>
                </q-item>

                <q-item-label header>Alarm volume</q-item-label>
                <q-item dense>
                    <q-item-section avatar>
                        <q-icon name="alarm" />
                    </q-item-section>
                    <q-item-section>
                        <q-slider color="teal" v-model="slideAlarm" :step="0" />
                    </q-item-section>
                </q-item>

                <q-item-label header>Ring volume</q-item-label>
                <q-item dense>
                    <q-item-section avatar>
                        <q-icon name="vibration" />
                    </q-item-section>
                    <q-item-section>
                        <q-slider color="teal" v-model="slideVibration" :step="0" />
                    </q-item-section>
                </q-item>
            </q-card>
            <q-card style="width: 300px" class="q-px-sm q-pb-md">
                <q-form @submit="onSubmit" @reset="onReset" class="q-gutter-md">
                    <q-card-section>
                        <div class="text-h6">Volumes</div>
                    </q-card-section>
                    <q-input filled v-model="name" label="Your name *" hint="Name and surname" lazy-rules :rules="[val => val && val.length > 0 || 'Please type something']" />

                    <q-input filled type="number" v-model="age" label="Your age *" lazy-rules :rules="[
                        val => val !== null && val !== '' || 'Please type your age',
                        val => val > 0 && val < 100 || 'Please type a real age'
                    ]" />

                    <q-toggle v-model="accept" label="I accept the license and terms" />

                    <div>
                        <q-btn label="Submit" type="submit" color="primary" />
                        <q-btn label="Reset" type="reset" color="primary" flat class="q-ml-sm" />
                    </div>
                </q-form>
            </q-card>

        </template>
    </Layout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

import Layout from "@/Layouts/QuasarLayoutDefault.vue";

const page = usePage();
console.log(page.props.data);
const journal = page.props.data;
let currentTitle = "";

const updateSectionTitle = (title) => {
    currentTitle = title;
    return true;
};

const onFabClick = (arg) => {
    console.log('click');
}

const columns = [
    {
        name: "Course",
        align: "center",
        label: "Занятие",
        field: (row) => row.journalable.title,
        sortable: true,
    },
    {
        name: "user",
        required: true,
        label: "Ученик",
        align: "left",
        field: (row) => row.user.name,
        format: (val) => `${val}`,
        sortable: true,
    },
];
</script>
