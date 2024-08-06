<template>
  <div>
    <header-bar></header-bar>
    <div
      class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-4 tw-p-10"
    >
      <v-skeleton-loader :loading="tabStore.mainLoading" type="card">
        {{ postStore.getPosts }}
        <div v-for="post in postStore.getPosts.posts" :key="post.id">
          <v-card>
            <v-card-title>{{ post.panda }}</v-card-title>
            <v-card-text>{{ post.link }}</v-card-text>
          </v-card>
        </div>
      </v-skeleton-loader>
    </div>
    <CreateModal />
    <v-fab
      @click="postDialStore.setDialog(true)"
      color="primary"
      icon="mdi-plus"
      class="n-ms-4 mb-4"
      location="bottom end"
      size="64"
      absolute
      app
      appear
    ></v-fab>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import HeaderBar from '@/components/bars/HeaderBar.vue'
import { useNavStore } from '@/stores/tab.store'
import { useRouter } from 'vue-router'
import CreateModal from '@/components/modals/CreateModal.vue'
import { useCreatePostStore } from '@/stores/createpost.store'
import { usePostStore } from '@/stores/post.store'

const postStore = usePostStore()
const tabStore = useNavStore()
const router = useRouter()
const postDialStore = useCreatePostStore()

if (router.currentRoute.value.name === 'new-post') {
  postDialStore.setDialog(true)
}

onMounted(async () => {
  tabStore.setMainLoading(true)
  await postStore.fetchPosts().then((res) => {
    tabStore.setMainLoading(false)
    console.log('Posts fetched', res)
  })
})
</script>
