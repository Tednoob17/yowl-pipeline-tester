import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useNavStore = defineStore('tab', () => {
    const tabs = ref(0);
    const drawer = ref(false);

    const getDrawer = computed(() => drawer.value);

    function setDrawer(val = !drawer.value)
    {
        drawer.value = val;
    }

    return {
        tabs,
        drawer,
        getDrawer,
        setDrawer
    }
})
