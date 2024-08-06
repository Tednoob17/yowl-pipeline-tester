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
        posts.value.posts.unshift({
            panda: post.panda,
            link: post.link,
            images: post.images,
        })
        await serve.createPost(post).then(response => {
            posts.value.posts.unshift(response.data)
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
            const new_table = posts.value.posts.filter(p => p.id !== id)
            posts.value.posts = new_table
        }).catch(error => {
            console.error(error)
        })
    }

    function setPost(post)
    {
        post.value = post
    }

    return {
        posts,
        post,
        getPosts,
        fetchPosts,
        setPost,
        fetchPost,
        createPost,
        updatePost,
        deletePost
    }
})
