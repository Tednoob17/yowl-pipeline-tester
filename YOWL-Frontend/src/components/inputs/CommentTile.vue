<script setup>
import { usePostStore } from '@/stores/post.store'

const postStore = usePostStore()

defineProps({
  comment: Object,
  auth: Object
})

function deleteComment(id) {
  postStore.deleteComment(id)
}
</script>

<template>
  <v-list-item :title="comment.content" :subtitle="comment.user.name">
    <template #append v-if="auth.id === comment.user.id">
      <v-btn @click="deleteComment(comment.id)" icon="mdi-delete" variant="text"></v-btn>
    </template>
  </v-list-item>
</template>
