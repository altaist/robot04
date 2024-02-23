<template>
    <q-layout view="hHh lpR fFf">

        <q-header reveal elevated class="bg-primary text-white">
            <q-toolbar>
                <q-btn dense flat round icon="keyboard_arrow_left" @click="toggleLeftDrawer" />

                <q-toolbar-title>
                    <!--q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar-->
                    {{ title }}
                </q-toolbar-title>
            </q-toolbar>
        </q-header>

        <!--q-drawer v-model="" side="left" behavior="desktop" bordered>
        </q-drawer-->
        <q-drawer v-model="leftDrawerOpen" :width="200" :breakpoint="500" behavior="desktop" bordered :class="$q.dark.isActive ? 'bg-grey-9' : 'bg-grey-3'">
            <q-scroll-area class="fit">
                <q-list>
                    <template v-for="(menuItem, index) in defaultMenuList" :key="index">
                        <q-item clickable :active="menuItem.label === 'Outbox'" v-ripple>
                            <q-item-section avatar>
                                <q-icon :name="menuItem.icon" />
                            </q-item-section>
                            <q-item-section>
                                {{ menuItem.label }}
                            </q-item-section>
                        </q-item>
                        <q-separator :key="'sep' + index" v-if="menuItem.separator" />
                    </template>

                </q-list>
            </q-scroll-area>
        </q-drawer>

        <q-page-container>
            <q-page padding>
                <slot name="page"></slot>
                <!--q-page-sticky position="bottom-right" :offset="[18, 18]">
                    <q-fab v-model="fab1" label-position="left" color="purple" icon="keyboard_arrow_right" direction="up" >
                        <q-fab-action color="primary" @click="onClick" icon="mail" label="Email" />
                        <q-fab-action color="secondary" @click="onClick" icon="alarm" label="Alarm" />
                    </q-fab>
                </q-page-sticky-->
                <q-page-sticky position="bottom-right" :offset="[18, 18]">
                    <!--q-btn fab icon="add" color="accent" @click="onFabClick"/-->
                    <q-fab icon="add" color="accent" @click="onFabClick">
                        <!--q-fab-action @click="onFabClick" color="primary" icon="person_add" />
                        <q-fab-action @click="onClick" color="primary" icon="mail" /-->
                    </q-fab>
                </q-page-sticky>
                <q-page-scroller position="bottom-left" :scroll-offset="150" :offset="[18, 18]">
                    <q-btn fab icon="keyboard_arrow_up" color="accent" />
                </q-page-scroller>
            </q-page>

        </q-page-container>

        <q-footer reveal elevated class="bg-grey-8 text-white">
            <q-toolbar>
                <q-toolbar-title>
                    <q-avatar>
                        <img src="https://cdn.quasar.dev/logo-v2/svg/logo-mono-white.svg">
                    </q-avatar>



                </q-toolbar-title>
                <span class="text-h6">robot04.ru</span>
            </q-toolbar>
        </q-footer>
    </q-layout>
    <q-dialog v-model="dialogFormEdit">
        <slot name="dialog_form_edit"/>
    </q-dialog>
</template>

<script setup>
import { ref } from 'vue'


defineProps({
    showFab: {
        type: Boolean,
    },
    title: {
        type: String,
    },
});

const emit = defineEmits(['fab:click', 'submit'])

const dialogFormEdit = ref(false);
const dialogFormView = ref(false);
const dialogFormDescription = ref(false);

const leftDrawerOpen = ref(false);
const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value
}

const onFabClick = (arg) => {
    dialogFormEdit.value = !dialogFormEdit.value;
    emit('fab:click', arg);
}

const defaultMenuList = [
    {
        icon: 'inbox',
        label: 'Inbox',
        separator: true
    },
    {
        icon: 'send',
        label: 'Outbox',
        separator: false
    },
    {
        icon: 'delete',
        label: 'Trash',
        separator: false
    },
    {
        icon: 'error',
        label: 'Spam',
        separator: true
    },
    {
        icon: 'settings',
        label: 'Settings',
        separator: false
    },
    {
        icon: 'feedback',
        label: 'Send Feedback',
        separator: false
    },
    {
        icon: 'help',
        iconColor: 'primary',
        label: 'Help',
        separator: false
    }
]

</script>
