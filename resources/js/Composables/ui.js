import { ref } from 'vue'

const tabsModel = ref('');
const tabsValues = ref([{}]);

const headerExpanded = ref(false);

const visibilityForEditForm = ref(false);

const showNewForm = ref(false);
const showViewForm = ref(false);
const showItemEditForm = ref(false);
const showItemNewForm = ref(false);
const loading = ref(false);


export const useUi = () => {
    const setTab = val => tab.value = val;
    let tmpLoading = false;


    const showLoading = (delay = 100) => {
        setTimeout(() => { loading.value = tmpLoading }, delay);
    }
    const hideLoading = (delay = 100) => {
        setTimeout(() => { loading.value = tmpLoading = false }, delay);
    }

    return {
        tabsModel,
        headerExpanded,
        setTab,
        visibilityForEditForm,
        showNewForm,
        showViewForm,
        showItemEditForm,
        showItemNewForm,
        loading,
        showLoading,
        hideLoading
    }
}
