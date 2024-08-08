<script setup>
import { RouterView } from 'vue-router'
import DrawerBar from './components/bars/DrawerBar.vue'
import { VSonner } from 'vuetify-sonner'
import FooterBar from './components/bars/FooterBar.vue';
import { useCreatePostStore } from './stores/createpost.store'

const postDialStore = useCreatePostStore()
</script>

<template>
  <v-app color="transparent" class="tw-backdrop-blur-lg">
    <drawer-bar></drawer-bar>
    <v-main>
      <RouterView />
      <VSonner />
    </v-main>
    <v-fab
        @click="postDialStore.setDialog(true)"
        icon="mdi-plus"
        location="bottom end"
        class="tw-text-white"
        color="primary"
        size="64"
        fixed
        app
        appear
      ></v-fab>
    <footer-bar></footer-bar>
  </v-app>
</template>
