<script setup>
import { useRouter } from 'vue-router'
import { usePostStore } from '@/stores/post.store'
import { ref } from 'vue'
import { useCreatePostStore } from '@/stores/createpost.store';
import { utilsService } from '@/services/utils.service';

const dialogStore = useCreatePostStore()
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
  <v-dialog v-model="dialogStore.postDialog">
    <v-card>
      <v-card-title> Créer un nouveau panda </v-card-title>
      <v-form>
        <v-card-text>
          <v-text-field v-model="content" label="Votre commentaire" outlined></v-text-field>
          <v-text-field
            :disabled="locked"
            v-model="link"
            placeholder="Lien du contenu"
            outlined
            :error-messages="errors"
          ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn> Annuler </v-btn>
          <v-btn @click="submit"> Valider </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
</template>
