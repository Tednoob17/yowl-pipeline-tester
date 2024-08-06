<script setup>
import { useNavStore } from '@/stores/tab.store';
import { useCreatePostStore } from '@/stores/createpost.store';

const dialogStore = useCreatePostStore();
const tabStore = useNavStore();
</script>
<template>
  <div class="tw-flex tw-shadow-xl" color="white" elevation="2">
    <v-app-bar-nav-icon @click="tabStore.setDrawer()" class="tw-my-auto"></v-app-bar-nav-icon>
    <div class="tw-flex tw-w-full tw-flex-col tw-justify-between">
      <div class="tw-m-4">Featured</div>
      <v-tabs v-model="tabStore.tabs">
        <v-tab value="recent">Recents<v-icon>mdi-history</v-icon></v-tab>
        <v-tab value="hot">Hot <v-icon>mdi-fire</v-icon></v-tab>
        <v-tab value="rising">Rising <v-icon>mdi-panda</v-icon></v-tab>
      </v-tabs>
    </div>
    <div class="tw-flex">
      <v-btn @click="dialogStore.setDialog()" class="tw-my-auto tw-mx-5" variant="text" color="primary">
        <v-icon>mdi-plus</v-icon>
        New panda
      </v-btn>
    </div>
  </div>
</template>
