import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { likeService } from '@/services/like.service'

export const useLikeStore = defineStore('like', () => {
  const likes = ref([])
  const liked = ref(false)
  const serve = likeService()

  const isLiked = computed(() => !!liked.value)

  function getLikes() {
    return likes.value
  }

  function getLikeCount() {
    return likes.value.length
  }

  function like() {
    liked.value = true
    likes.value.push({ id: likes.value.length + 1 })
  }

  function unlike() {
    liked.value = false
    likes.value.pop()
  }

  async function fetchLikes() {
    const response = await serve.getLikes()
    likes.value = response.data
  }

  async function likePost(postId, userId) {
    await serve.likePost(postId, userId)
    await fetchLikes()
  }

  async function haslikedPost(postId, userId) {
    const response = await serve.getLikes(postId)
    liked.value = response.data.some((like) => like.user_id === userId)
  }

  return {
    likes,
    liked,
    isLiked,
    getLikes,
    getLikeCount,
    fetchLikes,
    haslikedPost,
    likePost,
    like,
    unlike
  }
})
