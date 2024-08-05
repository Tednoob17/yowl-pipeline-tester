<script setup>
import { useNavStore } from '@/stores/tab.store';
import { ref }  from 'vue'
const navStore = useNavStore();
</script>
<template>
    <v-navigation-drawer app v-model="navStore.drawer">
        <v-img 
            src="/image/1.png"
        ></v-img>
        <v-list>
            
        </v-list>
    </v-navigation-drawer>
</template>