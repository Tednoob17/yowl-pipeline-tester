<script setup>
import { usePostStore } from '@/stores/post.store';
import { useNavStore } from '@/stores/tab.store';

const tabStore = useNavStore();
const postStore = usePostStore();
</script>

<template>
    <div class="text-center pa-4">
      <v-dialog
        v-model="tabStore.editDialog"
        transition="dialog-bottom-transition"
        fullscreen
      >  
        <v-card>
            Nexus post {{ postStore.post }}
            <button @click="tabStore.setEditDialog()">
                Btb
            </button>
        </v-card>
      </v-dialog>
    </div>
  </template>