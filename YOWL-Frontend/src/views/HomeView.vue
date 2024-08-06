<template>
  <div>
    <header-bar></header-bar>

    <v-skeleton-loader :loading="tabStore.mainLoading" type="card">
      <div
        class="tw-grid tw-grid-flow-row tw-grid-cols-1 sm:tw-grid-cols-2 md:tw-grid-cols-3 lg:tw-grid-cols-4 tw-gap-4 tw-p-5"
      >
        <div class="tw-w-full" v-for="post in postStore.getPosts.posts" :key="post.id">
          <v-card>
            <v-carousel
              v-if="post.images.length > 0"
              cycle
              height="200"
              hide-delimiters
              hide-controls
              :show-arrows="post.images.length > 1"
            >
              <v-carousel-item
                v-for="(image, index) in post.images"
                :key="index"
                :src="image.path"
                height="200"
                width="400"
                cover
              ></v-carousel-item>
            </v-carousel>
            <v-img
              v-else
              src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
              height="200"
              cover
            ></v-img>
            <v-card-title>{{ post.panda }}</v-card-title>
            <v-card-text>{{ post.link }}</v-card-text>
            <v-card-actions>
              <v-btn
                @click="postStore.setPost(post); tabStore.setEditDialog(true)"
                color="primary"
                icon="mdi-comment-multiple-outline"
                text
              ></v-btn>
              <v-btn
                @click="router.push({ name: 'edit-post', params: { id: post.id } })"
                color="black"
                icon="mdi-pencil"
                text
              ></v-btn>
              <v-spacer></v-spacer>
              <v-btn
                @click="postStore.deletePost(post.id)"
                color="error"
                icon="mdi-delete"
                text
              ></v-btn>
            </v-card-actions>
          </v-card>
        </div>
      </div>
    </v-skeleton-loader>

    <edit-modal />
    <CreateModal />
    <v-fab
      @click="postDialStore.setDialog(true)"
      color="primary"
      icon="mdi-plus"
      class="n-ms-4 mb-4"
      location="bottom end"
      size="64"
      fixed
      app
      appear
    ></v-fab>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import HeaderBar from '@/components/bars/HeaderBar.vue'
import { useNavStore } from '@/stores/tab.store'
import EditModal from '@/components/modals/EditModal.vue'
import { useRouter } from 'vue-router'
import CreateModal from '@/components/modals/CreateModal.vue'
import { useCreatePostStore } from '@/stores/createpost.store'
import { usePostStore } from '@/stores/post.store'
import { useAuthStore } from '@/stores/auth.store'

const authStore = useAuthStore()
const postStore = usePostStore()
const tabStore = useNavStore()
const router = useRouter()
const postDialStore = useCreatePostStore()

if (router.currentRoute.value.name === 'new-post') {
  postDialStore.setDialog(true)
}

onMounted(async () => {
  tabStore.setMainLoading(true)
  await authStore.initAuth().then(async () => {
    await postStore.fetchPosts().then(() => {
      tabStore.setMainLoading(authStore.authenticated)
    })
  })
})
</script>
