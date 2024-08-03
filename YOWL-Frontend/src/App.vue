<script setup>
import { RouterView } from 'vue-router'
import HeaderBar from '@/components/bars/HeaderBar.vue'
import { VSonner } from 'vuetify-sonner'
import { useAuthStore } from './stores/auth.store';

const authStore = useAuthStore();

authStore.initAuth();
</script>

<template>
  <v-app>
    <header-bar></header-bar>
    <v-main>
      <RouterView />
      <VSonner />
    </v-main>
  </v-app>
</template>
