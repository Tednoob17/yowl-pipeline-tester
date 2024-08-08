<script setup>
import { usePostStore } from '@/stores/post.store'
const postStore = usePostStore()
import { ref } from 'vue'

const props = defineProps({
  comment: Object,
  auth: Object
})

const show = ref(false)

function editComment() {
  postStore.editComment(props.comment.id, props.comment.content)
}

function deleteComment(id) {
  postStore.deleteComment(id)
}
</script>

<template>
  <v-list-item @click="show = !show" :title="comment.content" :subtitle="comment.user.name">
    <template #append v-if="auth.id === comment.user.id">
      <v-btn @click="deleteComment(comment.id)" icon="mdi-delete" variant="text"></v-btn>
    </template>
  </v-list-item>
  <v-dialog v-model="show">
    <v-card>
      <v-card-title>
        Edit your panda
      </v-card-title>
      <v-card-text>
        <v-text-field v-model="comment.content"></v-text-field>
      </v-card-text>
      <v-card-actions>
        <v-btn @click="deleteComment(comment.id)" color="error" text>Delete</v-btn>
        <v-spacer></v-spacer>
        <v-btn @click="editComment()" color="primary" text>Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
