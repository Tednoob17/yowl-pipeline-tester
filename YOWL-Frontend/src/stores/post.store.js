import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { postService } from '@/services/post.service'

export const usePostStore = defineStore('posts', () => {

    const posts = ref([])
    const serve = postService()
    const post = ref(null)

    const getPosts = computed(() => posts.value)

    async function fetchPosts() {
        await serve.getPosts().then(response => {
            posts.value = response.data
        }).catch(error => {
            console.error(error)
        })
    }

    async function fetchPost(id) {
        await serve.getPost(id).then(response => {
            post.value = response.data
        }).catch(error => {
            console.error(error)
        })
    }

    async function createPost(post) {
        await serve.createPost(post).then(response => {
            posts.value.push(response.data)
        }).catch(error => {
            console.error(error)
        })
    }

    async function updatePost(id, post) {
        await serve.updatePost(id, post).then(response => {
            const index = posts.value.findIndex(p => p.id === id)
            posts.value[index] = response.data
        }).catch(error => {
            console.error(error)
        })
    }

    async function deletePost(id) {
        await serve.deletePost(id).then(() => {
            posts.value = posts.value.filter(p => p.id !== id)
        }).catch(error => {
            console.error(error)
        })
    }

    return {
        posts,
        post,
        getPosts,
        fetchPosts,
        fetchPost,
        createPost,
        updatePost,
        deletePost
    }
})
