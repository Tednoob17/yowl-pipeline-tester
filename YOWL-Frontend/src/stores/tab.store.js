import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useNavStore = defineStore('tab', () => {
    const tabs = ref(0);
    const drawer = ref(false);
    const mainLoading = ref(false);

    const getDrawer = computed(() => drawer.value);

    const getMainLoading = computed(() => mainLoading.value);

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
        drawer,
        mainLoading,
        getMainLoading,
        setMainLoading,
        getDrawer,
        setDrawer
    }
})
