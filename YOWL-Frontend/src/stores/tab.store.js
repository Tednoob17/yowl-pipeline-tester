import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useNavStore = defineStore('tab', () => {
    const tabs = ref(0);
    const drawer = ref(false);
    const mainLoading = ref(false);
    const editDialog = ref(false);

    const getEditDialog = computed(() => editDialog.value);

    const getDrawer = computed(() => drawer.value);

    const getMainLoading = computed(() => mainLoading.value);

    function setEditDialog(val = !editDialog.value)
    {
        editDialog.value = val
    }

    function setMainLoading(val = !mainLoading.value)
    {
        mainLoading.value = val;
    }

    function setDrawer(val = !drawer.value)
    {
        drawer.value = val;
    }

    return {
        tabs,
        editDialog,
        setEditDialog,
        getEditDialog,
        drawer,
        mainLoading,
        getMainLoading,
        setMainLoading,
        getDrawer,
        setDrawer
    }
})
