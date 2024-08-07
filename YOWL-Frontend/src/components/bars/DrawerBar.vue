<script setup>
import { ref, onMounted } from 'vue'
import { useNavStore } from '@/stores/tab.store'
import { useAuthStore } from '@/stores/auth.store'
const navStore = useNavStore()
const authStore = useAuthStore()
const username = ref('')
</script>

<template>
  <v-navigation-drawer app v-model="navStore.drawer">
    <v-img src="/image/1.png"></v-img>
    <v-list>
      <v-list-item to="/">
        <template v-slot:prepend>
          <v-icon icon="mdi-home"></v-icon>
        </template>
        <v-list-item-title>Home</v-list-item-title>
      </v-list-item>
      <v-list-item :to="`/profile`">
        <template v-slot:prepend>
          <v-icon icon="mdi-account"></v-icon>
        </template>
        <v-list-item-title>Profile</v-list-item-title>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>
