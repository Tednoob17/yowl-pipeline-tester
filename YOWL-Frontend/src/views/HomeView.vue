<template>
    <div>
        {{ postStore.getPosts }}
        <CreateModal />
    </div>
</template>

<script setup>
import { ref, onBeforeMount } from 'vue'
import { useRouter } from 'vue-router'
import CreateModal from '@/components/CreateModal.vue';
import { useCreatePostStore } from '@/stores/createpost.store';

const router = useRouter()
const postStore = useCreatePostStore()

if(router.currentRoute.value.name === 'new-post')
{
    postStore.setDialog(true);
}

onBeforeMount(() => {

})
</script>