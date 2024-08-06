<script setup>
import { ref } from 'vue';
import { useNavStore } from '@/stores/tab.store';
import { useCreatePostStore } from '@/stores/createpost.store';
import { useRouter } from 'vue-router';

const router = useRouter();
const show_tabs = ref(false);
const dialogStore = useCreatePostStore();
const tabStore = useNavStore();

if (router.currentRoute.value.name === 'new-post' || router.currentRoute.value.name === 'home') {
  show_tabs.value = true;
}
</script>
<template>
  <div class="tw-flex tw-shadow-xl" color="white" elevation="2">
    <v-app-bar-nav-icon @click="tabStore.setDrawer()" class="tw-my-auto"></v-app-bar-nav-icon>
    <div class="tw-flex tw-w-full tw-flex-col tw-justify-between">
      <div  class="tw-m-4">Featured</div>
      <v-tabs v-if="show_tabs" v-model="tabStore.tabs">
        <v-tab value="recent">Recents<v-icon>mdi-history</v-icon></v-tab>
        <v-tab value="hot">Hot <v-icon>mdi-fire</v-icon></v-tab>
        <v-tab value="rising">Rising <v-icon>mdi-panda</v-icon></v-tab>
      </v-tabs>
    </div>
  </div>
</template>
