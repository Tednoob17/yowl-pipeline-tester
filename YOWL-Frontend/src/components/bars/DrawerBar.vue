<script setup>
import { useNavStore } from '@/stores/tab.store';
import { ref }  from 'vue'
const navStore = useNavStore();
</script>
<template>
    <v-navigation-drawer v-model="navStore.drawer">

    </v-navigation-drawer>
</template>