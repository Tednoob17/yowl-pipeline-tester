<template>
  <div class="tw-h-[80vh] tw-flex tw-justify-center tw-items-center">
    <div class="tw-w-full sm:tw-w-1/2">
      <v-card>
        <v-card-title> Ajouter un nouveau panda </v-card-title>
        <v-card-text>
          <v-form>
            <v-text-field v-model="content" label="Votre commentaire" outlined></v-text-field>
            <v-text-field
              :disabled="locked"
              v-model="link"
              placeholder="Lien du contenu"
              outlined
              :error-messages="errors"
            ></v-text-field>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn> Annuler </v-btn>
              <v-btn @click="submit"> Valider </v-btn>
            </v-card-actions>
          </v-form>
        </v-card-text>
      </v-card>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { usePostStore } from '@/stores/post.store'
import { utilsService } from '@/services/utils.service'
import { ref } from 'vue'

const postStore = usePostStore()
const router = useRouter()
const link = ref('')
const content = ref('')
const errors = ref('')
const locked = ref(false)

const submit = async () => {
  await postStore
    .createPost({ panda: content.value, link: link.value })
    .then(() => {
      router.push({ name: 'home' })
    })
    .catch((error) => {
      console.log(error)
      errors.value = error
    })
}

async function loadlink() {
  const id = router.currentRoute.value.params.id
  console.log(id)
  if (!id) return

  const service = utilsService()

  link.value = await service.getVal('extension-web/' + id).then((res) => {
    return res.data.extensionWeb.link
  })

  console.log(link.value)
}

if (router.currentRoute.value.name === 'new-post' && !!router.currentRoute.value.params.id) {
  locked.value = true
  await loadlink()
}
</script>
