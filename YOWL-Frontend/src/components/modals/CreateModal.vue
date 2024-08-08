<script setup>
import { useRouter } from 'vue-router'
import { usePostStore } from '@/stores/post.store'
import { ref } from 'vue'
import { useCreatePostStore } from '@/stores/createpost.store'
import { utilsService } from '@/services/utils.service'

const dialogStore = useCreatePostStore()
const postStore = usePostStore()
const router = useRouter()
const link = ref('')
const form = ref(null)
const content = ref('')
const image = ref(null)
const locked = ref(false)

const submit = async () => {
  if (!(content.value && link.value)) return

  const pattern = /^(http|https):\/\/[^ "]+$/
  if (!pattern.test(link.value)) {
    return
  }

  postStore
    .createPost({ panda: content.value, link: link.value, file: image.value })
    .then((res) => {
      dialogStore.setDialog(false)
      console.log(res)
    })
    .catch((error) => {
      console.log(error)
    })
}

const rules = {
  required: (value) => !!value || 'Required.',
  url: (value) => {
    const pattern = /^(http|https):\/\/[^ "]+$/
    return pattern.test(value) || 'Invalid URL.'
  }
}

async function loadlink() {
  const id = router.currentRoute.value.params.id
  if (!id) return

  const service = utilsService()

  link.value = await service.getVal('extension-web/' + id).then((res) => {
    return res.data.extensionWeb.link
  })
}

if (router.currentRoute.value.name === 'new-post' && !!router.currentRoute.value.params.id) {
  locked.value = true
  await loadlink()
}
</script>

<template>
  <v-dialog class="bg-transparent" v-model="dialogStore.postDialog">
    <v-card class="tw-backdrop-blur-xl tw-bg-transparent tw-text-white">
      <v-card-title> Créer un nouveau panda </v-card-title>
      <v-form ref="form" class="tw-w-full">
        <v-card-text>
          <v-text-field
            :rules="[rules.required]"
            v-model="content"
            label="Votre commentaire"
            outlined
          ></v-text-field>
          <v-text-field
            :rules="[rules.required, rules.url]"
            :disabled="locked"
            v-model="link"
            placeholder="Lien du contenu"
            outlined
          ></v-text-field>
          <v-file-input clearable v-model="image" accept="image/*" label="Image">
            <template v-slot:prepend>
              <v-chip v-if="image" label close @click:close="image = null">
                {{ image.name }}
              </v-chip>
            </template>
          </v-file-input>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="dialogStore.setDialog(false)" class="tw-mr-2" color="error">
            Cancel
          </v-btn>
          <v-btn color="black" @click="submit"> Valider </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
</template>
