<script setup>
import { useNavStore } from '@/stores/tab.store'
import { useAuthStore } from '@/stores/auth.store'
const navStore = useNavStore()
const authStore = useAuthStore()
</script>

<template>
  <v-navigation-drawer color="transparent" class="tw-backdrop-blur-lg" app v-model="navStore.drawer">
    <v-img src="/image/1.png"></v-img>
    <v-list v-if="authStore.user.id">
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
      <v-list-item @click="authStore.logout">
        <template v-slot:prepend>
          <v-icon icon="mdi-logout"></v-icon>
        </template>
        <v-list-item-title>Logout</v-list-item-title>
      </v-list-item>
    </v-list>
    <v-list v-else>
      <v-list-item to="/login">
        <template v-slot:prepend>
          <v-icon icon="mdi-login"></v-icon>
        </template>
        <v-list-item-title>Authentication</v-list-item-title>
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
