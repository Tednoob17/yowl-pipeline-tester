import { ref } from 'vue'
import { defineStore } from 'pinia'
import { usePostStore } from './post.store';

export const useCreatePostStore = defineStore('createpost', () => {
    const postStore = usePostStore();
    const postDialog = ref(false);

    function setDialog(val = !postDialog.value)
    {
        postDialog.value = val;
    }

    const post = ref({
        panda: '',
    });

    async function createpost()
    {
        await postStore.createPost(post)
    }

    function setContent(val)
    {
        post.value.content = val;
    }

    return {
        post,
        setContent,
        createpost,
        postDialog,
        setDialog,
    }
});