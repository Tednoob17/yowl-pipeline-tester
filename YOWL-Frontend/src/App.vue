<script setup>
import { onBeforeMount } from 'vue'
import { RouterView } from 'vue-router'
import DrawerBar from './components/bars/DrawerBar.vue';
import { VSonner } from 'vuetify-sonner'
import { useAuthStore } from './stores/auth.store';

const authStore = useAuthStore()

onBeforeMount(() => {
  authStore.initAuth()
})
</script>

<template>
  <v-app>
    <drawer-bar></drawer-bar>
    <v-main>
      <RouterView />
      <VSonner />
    </v-main>
  </v-app>
</template>
