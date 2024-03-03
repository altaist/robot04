import { ref } from 'vue'

const tab = ref('');
const headerExpanded = ref(false);

const showEditForm = ref(false);
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
        setTimeout(() => { loading.value = tpmLoading = false }, delay);
    }

    return {
        tab,
        headerExpanded,
        setTab,
        showEditForm,
        showNewForm,
        showViewForm,
        showItemEditForm,
        showItemNewForm,
        loading,
        showLoading,
        hideLoading
    }
}
