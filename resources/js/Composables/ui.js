import { ref } from 'vue'

export const useUi = () => {
    const tab = ref('');
    const headerExpanded = ref(false);

    const showEditForm = ref(false);
    const showNewForm = ref(false);
    const showViewForm = ref(false);
    const showItemEditForm = ref(false);
    const showItemNewForm = ref(false);
    const loading = ref(false);
    const showLoading = ref(false);

    const setTab = val => tab.value = val;

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
        showLoading
    }
}
