import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { postService } from '@/services/post.service'

export const usePostStore = defineStore('posts', () => {
  const posts = ref([])
  const serve = postService()
  const post = ref({})

  const getPosts = computed(() => posts.value)

  async function fetchPosts() {
    await serve
      .getPosts()
      .then((response) => {
        posts.value = response.data
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function fetchPost(id) {
    await serve
      .getPost(id)
      .then((response) => {
        post.value = response.data.post
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function createPost(post) {
    await serve
      .createPost(post)
      .then(async () => {
        await fetchPosts()
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function updatePost(id, post) {
    const index = posts.value.data.findIndex((p) => p.id === id)
    posts.value[index] = response.data
    await serve
      .updatePost(id, post)
      .then((response) => {
        fetchPosts()
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function deletePost(id) {
    console.log(posts.value);
    const new_table = posts.value.data.filter((p) => p.id !== id)
    posts.value = new_table
    await serve
      .deletePost(id)
      .then(() => {
        console.log(posts.value)
        fetchPosts()
      })
      .catch((error) => {
        console.error(error)
      })
  }

  function setPost(posts) {
    post.value = posts
  }

  async function newComment(comment, post_id, user_id) {
    await serve
      .newComment(comment, post_id, user_id)
      .then((response) => {
        post.value.comment = response.data.comments
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function deleteComment(id) {
    await serve
      .deleteComment(id)
      .then(() => {
        const new_table = post.value.comment.filter((p) => p.id !== id)
        post.value.comment = new_table
      })
      .catch((error) => {
        console.error(error)
      })
  }

  return {
    posts,
    post,
    getPosts,
    newComment,
    deleteComment,
    fetchPosts,
    setPost,
    fetchPost,
    createPost,
    updatePost,
    deletePost
  }
})
