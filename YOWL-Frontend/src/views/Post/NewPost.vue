<template>
  <div class="tw-h-[80vh] tw-flex tw-justify-center tw-items-center">
    <div v-if="!!link">
      <v-card>
        <v-card-title> Ajouter un nouveau panda </v-card-title>
        <v-card-card-text>
          <v-form>
            <v-text-field v-model="content" label="Votre commentaire" outlined></v-text-field>
            <v-text-field
              :disabled="locked"
              v-model="link"
              label="Lien du contenu"
              outlined
            ></v-text-field>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn> Annuler </v-btn>
              <v-btn @click="submit"> Valider </v-btn>
            </v-card-actions>
          </v-form>
        </v-card-card-text>
      </v-card>
    </div>
    <div v-else>
      <v-card>
        <v-card-title> Ajouter un nouveau panda </v-card-title>
        <v-card-card-text>
          <v-form>
            <v-text-field v-model="content" label="Votre commentaire" outlined></v-text-field>
            <v-text-field v-model="link" label="Lien du contenu" outlined></v-text-field>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn> Annuler </v-btn>
              <v-btn @click="submit"> Valider </v-btn>
            </v-card-actions>
          </v-form>
        </v-card-card-text>
      </v-card>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { ref } from 'vue'

const router = useRouter()
const link = ref('')
const locked = ref(false)

if (router.currentRoute.value.name === 'new-post' && !!router.currentRoute.value.params.id) {
  link.value = localStorage.getItem('page')
  locked.value = true
}
</script>
