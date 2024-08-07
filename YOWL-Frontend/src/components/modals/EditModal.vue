<script setup>
import { onBeforeMount, ref } from 'vue'
import { usePostStore } from '@/stores/post.store'
import { useNavStore } from '@/stores/tab.store'
import { useAuthStore } from '@/stores/auth.store'

const authStore = useAuthStore()
const tabStore = useNavStore()
const postStore = usePostStore()
const comment = ref('')

function addComment(commentaire, post_id, user_id) {
  postStore.newComment(commentaire, post_id, user_id)
}
</script>

<template>
  <div class="text-center pa-4">
    <v-dialog v-model="tabStore.editDialog" transition="dialog-bottom-transition" fullscreen>
      <v-sheet>
        <v-card>
          <v-carousel
            v-if="postStore.post.images.length > 0"
            cycle
            hide-delimiters
            height="500"
            :show-arrows="postStore.post.images.length > 1"
          >
            <v-carousel-item
              v-for="(item, i) in postStore.post.images"
              :key="i"
              :src="item.path"
              cover
              width="100%"
            >
              <v-fab
                icon="mdi-dots-horizontal"
                class="bg-transparent mr-4 mt-4"
                location="top right"
                size="64"
                :flat="true"
                absolute
              ></v-fab>
            </v-carousel-item>
          </v-carousel>
          <v-card-title>
            {{ postStore.post.panda }}
          </v-card-title>
          <v-card-text>
            {{ postStore.post.link }}
          </v-card-text>
          <v-card-actions>
            <v-icon color="primary" icon="mdi-comment-multiple-outline"></v-icon>
            <div class="tw-mx-2">
              {{ postStore.post.comment.length }}
            </div>
            <v-icon color="error" icon="mdi-heart"></v-icon>
            <div class="tw-mx-2">
              {{ postStore.post.likes.length }}
            </div>
            <v-btn
              v-if="authStore.user.id === postStore.post.user.id"
              @click="true"
              color="black"
              icon="mdi-pencil"
              text
            ></v-btn>
            <v-spacer></v-spacer>
            <v-btn
              v-if="authStore.user.id === postStore.post.user.id"
              @click="postStore.deletePost(postStore.post.id)"
              color="error"
              icon="mdi-delete"
              text
            ></v-btn>
          </v-card-actions>
        </v-card>
        <v-fab
          @click="tabStore.setEditDialog(false)"
          icon="mdi-arrow-left-top"
          class="mr-4 mb-10"
          location="bottom right"
          size="50"
        ></v-fab>
        <v-card>
          <v-card-title> other panda's </v-card-title>
          <v-card-text>
            <v-text-field
              @click="addComment(comment, post.id, authStore.user.id)"
              v-model="comment"
              label="Comment"
              outlined
              dense
              clearable
            ></v-text-field>
            <v-list>
              {{ postStore.post.comment }}
            </v-list>
          </v-card-text>
        </v-card>
      </v-sheet>
    </v-dialog>
  </div>
</template>
