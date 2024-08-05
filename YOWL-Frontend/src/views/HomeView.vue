<template>
    <div>
        {{ postStore.getPosts }}
    </div>
</template>

<script setup>
import { ref, onBeforeMount } from 'vue'
import { usePostStore } from '@/stores/post.store';

const postStore = usePostStore()

onBeforeMount(() => {
    postStore.fetchPosts()
})
</script>