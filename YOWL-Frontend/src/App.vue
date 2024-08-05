<script setup>
import { RouterView } from 'vue-router'
import HeaderBar from '@/components/bars/HeaderBar.vue'
import DrawerBar from './components/bars/DrawerBar.vue';
import { VSonner } from 'vuetify-sonner'
import { useAuthStore } from './stores/auth.store';

const authStore = useAuthStore();

authStore.initAuth();
</script>

<template>
  <v-app>
    <header-bar></header-bar>
    <drawer-bar></drawer-bar>
    <v-main>
      <RouterView />
      <VSonner />
    </v-main>
  </v-app>
</template>
