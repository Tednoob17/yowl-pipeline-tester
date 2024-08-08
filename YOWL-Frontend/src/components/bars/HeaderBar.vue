<script setup>
import { ref } from 'vue'
import { useNavStore } from '@/stores/tab.store'
import { useCreatePostStore } from '@/stores/createpost.store'
import { useRouter } from 'vue-router'

const router = useRouter()
const show_tabs = ref(false)
const dialogStore = useCreatePostStore()
const tabStore = useNavStore()

if (router.currentRoute.value.name === 'new-post' || router.currentRoute.value.name === 'home') {
  show_tabs.value = true
}
</script>
<template>
  <v-toolbar fixed color="transparent" class="tw-backdrop-blur-lg">
    <v-app-bar-nav-icon @click="tabStore.setDrawer()"></v-app-bar-nav-icon>

    <v-toolbar-title>Free Panda's</v-toolbar-title>

    <v-spacer></v-spacer>

    <v-btn icon="mdi-magnify"></v-btn>

    <template v-slot:extension>
      <v-tabs align-tabs="title" v-if="show_tabs" v-model="tabStore.tabs">
        <v-tab value="recent">Recents<v-icon>mdi-history</v-icon></v-tab>
        <v-tab value="hot">Hot <v-icon>mdi-fire</v-icon></v-tab>
        <v-tab value="rising"> All posts <v-icon>mdi-panda</v-icon></v-tab>
      </v-tabs>
    </template>
  </v-toolbar>
</template>
