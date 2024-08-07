import { ref } from 'vue'
import { defineStore } from 'pinia'
import { usePostStore } from './post.store'

export const useCommentStore = defineStore('comment', () => {
  const comments = ref([])

  async function getComments($post_id) {
    
  }

  async function addComment($post_id, $comment) {
    
  }

  return {
    comments
  }
})
