<script setup>
import { RouterView } from 'vue-router'
import DrawerBar from './components/bars/DrawerBar.vue'
import { VSonner } from 'vuetify-sonner'
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
