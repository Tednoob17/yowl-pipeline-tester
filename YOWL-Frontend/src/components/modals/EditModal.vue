<script setup>
import { ref } from 'vue'
import CommentTile from '../inputs/CommentTile.vue'
import { usePostStore } from '@/stores/post.store'
import { useNavStore } from '@/stores/tab.store'
import { useAuthStore } from '@/stores/auth.store'
import { toast } from 'vuetify-sonner'

const authStore = useAuthStore()
const tabStore = useNavStore()
const postStore = usePostStore()
const comment = ref('')

const iseditingpost = ref(false)

function addComment(commentaire, post_id, user_id) {
  if (commentaire === '') {
    toast.error('Panda vide')
  }
  postStore.newComment(commentaire, post_id, user_id)
  comment.value = ''
}

function completeUpdate() {
  iseditingpost.value = !iseditingpost.value
  updatePost
}

function deletePost() {
  postStore.deletePost(postStore.post.id)
  tabStore.editDialog = false
}

function updatePost() {
  postStore.updatePost(postStore.post.id, postStore.post)
}
</script>

<template>
  <div class="text-center pa-4">
    <v-dialog
      class="bg-transparent tw-backdrop-blur-lg"
      v-model="tabStore.editDialog"
      transition="dialog-bottom-transition"
      fullscreen
    >
      <v-sheet class="tw-backdrop-blur-lg">
        <v-card class="bg-transparent">
          <v-fab
            @click="tabStore.editDialog = false"
            icon="mdi-arrow-left-top-bold"
            class="bg-transparent mr-4 mt-4"
            location="top right"
            size="64"
            :flat="true"
            absolute
          ></v-fab>
          <v-carousel
            v-if="postStore.post.images.length > 0"
            cycle
            hide-delimiters
            height="300"
            :show-arrows="postStore.post.images.length > 1"
          >
            <v-carousel-item
              v-for="(item, i) in postStore.post.images"
              :key="i"
              :src="item.path"
              cover
              width="100%"
            >
            </v-carousel-item>
          </v-carousel>
          <div v-if="iseditingpost">
            <v-card-title>
              <v-text-field
                @keyup.enter="updatePost"
                v-model="postStore.post.panda"
                label="Panda"
                dense
                clearable
              ></v-text-field>
            </v-card-title>
            <v-card-text>
              <v-text-field
                @keyup.enter="updatePost"
                v-model="postStore.post.link"
                label="Link"
                dense
                clearable
              ></v-text-field>
            </v-card-text>
          </div>
          <div v-else>
            <v-card-title>
              {{ postStore.post.panda }}
            </v-card-title>
            <v-card-text>
              {{ postStore.post.link }}
            </v-card-text>
          </div>
          <v-card-actions>
            <v-icon color="primary" icon="mdi-comment-multiple-outline"></v-icon>
            <div class="tw-mx-2">
              {{ postStore.post.comment.length }}
            </div>
            <!--<v-icon color="error" icon="mdi-heart"></v-icon>
            <div class="tw-mx-2">
              {{ postStore.post.likes.length }}
            </div>-->
            <v-btn
              v-if="authStore.user.id === postStore.post.user.id"
              @click="completeUpdate"
              color="black"
              :icon="iseditingpost ? 'mdi-check' : 'mdi-pencil'"
              text
            ></v-btn>
            <v-spacer></v-spacer>
            <v-btn
              v-if="authStore.user.id === postStore.post.user.id"
              @click="deletePost"
              color="error"
              icon="mdi-delete"
              text
            ></v-btn>
          </v-card-actions>
        </v-card>

        <v-card>
          <v-card-title> other panda's </v-card-title>
          <v-card-text>
            <v-list>
              <comment-tile
                v-for="(item, i) in postStore.post.comment"
                :key="i"
                :comment="item"
                :auth="authStore.user"
              ></comment-tile>
            </v-list>
            <v-text-field
              @keyup.enter="addComment(comment, postStore.post.id, authStore.user.id)"
              v-model="comment"
              label="Comment"
              dense
              clearable
            ></v-text-field>
          </v-card-text>
        </v-card>
      </v-sheet>
    </v-dialog>
  </div>
</template>
