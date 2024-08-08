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

function editPost(post) {
  postStore.setPost(post)
  tabStore.setEditDialog(true, post.id)
}

onMounted(async () => {
  tabStore.setMainLoading(true)
  await authStore
    .initAuth()
    .then(async () => {
      await postStore
        .fetchPosts()
        .then(() => {
          tabStore.setMainLoading(!authStore.authenticated)
        })
        .catch(() => {
          tabStore.setMainLoading(false)
        })
    })
    .catch(() => {
      tabStore.setMainLoading(false)
    })
})
</script>

<template>
  <div class="root">
    <header-bar></header-bar>
    <!-- {{ postStore.getPosts }} -->
    <v-skeleton-loader
      class="bg-transparent"
      :loading="tabStore.mainLoading"
      type="card, list-item"
      height="100%"
    >
      <v-tabs-window class="tw-w-full tw-px-4 py-8 tw-h-screen" v-model="tabStore.tabs">
        <div
          class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-items-center tw-h-96"
          v-if="postStore.getPosts.post_recent < 1 && tabStore.tabs === 'recent'"
        >
          No panda found
        </div>
        <v-tabs-window-item
          v-else
          class="tw-w-full tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-4"
          value="recent"
        >
          <div class="" v-for="post in postStore.getPosts.post_recent" :key="post.id">
            <v-card class="bg-transparent tw-backdrop-blur-lg">
              <v-carousel
                v-if="post.images.length > 0"
                cycle
                height="200"
                width="100%"
                hide-delimiters
                hide-controls
                :show-arrows="post.images.length > 1"
              >
                <v-carousel-item
                  v-for="(image, index) in post.images"
                  :key="index"
                  :src="image.path"
                  height="200"
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
              <v-card-text>
                <a :href="post.link" target="_blank">{{ post.link }}</a>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  @click="editPost(post)"
                  color="primary"
                  icon="mdi-comment-multiple-outline"
                  text
                ></v-btn>
                <div class="mx-2">
                  {{ post.comment_count }}
                </div>
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
        </v-tabs-window-item>
        <div
          class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-items-center tw-h-96"
          v-if="postStore.getPosts.post_hot < 1 && tabStore.tabs === 'hot'"
        >
          No panda found
        </div>
        <v-tabs-window-item
          v-else
          class="tw-w-full tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-4"
          value="hot"
        >
          <div class="" v-for="post in postStore.getPosts.post_hot" :key="post.id">
            <v-card class="bg-transparent tw-backdrop-blur-lg">
              <v-carousel
                v-if="post.images.length > 0"
                cycle
                height="200"
                width="100%"
                hide-delimiters
                hide-controls
                :show-arrows="post.images.length > 1"
              >
                <v-carousel-item
                  v-for="(image, index) in post.images"
                  :key="index"
                  :src="image.path"
                  height="200"
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
              <v-card-text>
                <a :href="post.link" target="_blank">{{ post.link }}</a>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  @click="editPost(post)"
                  color="primary"
                  icon="mdi-comment-multiple-outline"
                  text
                ></v-btn>
                <div class="mx-2">
                  {{ post.comment_count }}
                </div>
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
        </v-tabs-window-item>
        <div
          class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-items-center tw-h-96"
          v-if="postStore.getPosts.post_all < 1 && tabStore.tabs === 'rising'"
        >
          No panda found
        </div>
        <v-tabs-window-item
          v-else
          class="tw-w-full tw-grid md:tw-grid-cols-2 lg:tw-grid-cols-3 xl:tw-grid-cols-4 tw-gap-4"
          value="rising"
        >
          <div class="" v-for="post in postStore.getPosts.post_all.data" :key="post.id">
            <v-card class="bg-transparent tw-backdrop-blur-lg">
              <v-carousel
                v-if="post.images.length > 0"
                cycle
                height="200"
                width="100%"
                hide-delimiters
                hide-controls
                :show-arrows="post.images.length > 1"
              >
                <v-carousel-item
                  v-for="(image, index) in post.images"
                  :key="index"
                  :src="image.path"
                  height="200"
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
              <v-card-text>
                <a :href="post.link" target="_blank">{{ post.link }}</a>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  @click="editPost(post)"
                  color="primary"
                  icon="mdi-comment-multiple-outline"
                  text
                ></v-btn>
                <div class="mx-2">
                  {{ post.comment_count }}
                </div>
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
        </v-tabs-window-item>
      </v-tabs-window>
    </v-skeleton-loader>

    <edit-modal />
    <CreateModal />
    <v-fab
      @click="postDialStore.setDialog(true)"
      icon="mdi-plus"
      location="bottom end"
      class="tw-text-white"
      color="transparent"
      size="64"
      fixed
      app
      appear
    ></v-fab>
  </div>
</template>

<style scoped>
.root {
  background-image: url('../assets/img/bg-login.png');
}
</style>
