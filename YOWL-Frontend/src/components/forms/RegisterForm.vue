<script setup>
import { ref, watch, computed } from 'vue'
import { useAuthStore } from '@/stores/auth.store'
import { useRouter } from 'vue-router'

const authStore = useAuthStore()

const user = ref({
  name: '',
  email: '',
  password: '',
  password_confirm: '',
  birthdate: '',
  terms: true
})

const errors = ref({
  name: '',
  email: '',
  password: '',
  password_confirm: '',
  birthdate: '',
  terms: ''
})

const isValid = computed(() => {
  return (
    !errors.value.name &&
    !errors.value.email &&
    !errors.value.password &&
    !errors.value.password_confirm &&
    !errors.value.birthdate &&
    !errors.value.terms
  )
})

const router = useRouter()

const register = () => {
  if (isValid) {
    authStore
      .register(user.value)
      .then(() => {
        router.push('/')
      })
      .catch((error) => {
        if (error.response) {
          errors.value.name = error?.response.data.name
            ? error.response.data.name.join('</br>')
            : ''
          errors.value.email = error?.response.data.email
            ? error.response.data.email.join('</br>')
            : ''
          errors.value.birthdate = error?.response.data.birthdate
            ? error.response.data.birthdate.join('</br>')
            : ''
          errors.value.password = error?.response.data.password
            ? error.response.data.password.join('</br>')
            : ''
          errors.value.password_confirm = error?.response.data.password_confirm
            ? error.response.data.password_confirm.join('</br>')
            : ''
        } else {
          errors.value.email = 'Something went wrong'
        }
      })
  }
}

watch(
  () => user.value.email,
  (value) => {
    if (!value.includes('@')) {
      errors.value.email = 'Please enter a valid email'
    } else {
      errors.value.email = ''
    }
  }
)

watch(
  () => user.value.password,
  (value) => {
    if (!value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/)) {
      errors.value.password =
        'Password should contain at least 8 characters, 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character'
    } else {
      errors.value.password = ''
    }
  }
)

watch(
  () => user.value.password_confirm,
  (value) => {
    if (value !== user.value.password) {
      errors.value.password_confirm = 'Passwords do not match'
    } else {
      errors.value.password_confirm = ''
    }
  }
)

watch(
  () => user.value.birthdate,
  (value) => {
    if (!value) {
      errors.value.birthdate = 'Please enter your birthdate'
    } else {
      errors.value.birthdate = ''
    }
  }
)

watch(
  () => user.value.terms,
  (value) => {
    if (!value) {
      errors.value.terms = 'Please accept the terms and conditions'
    } else {
      errors.value.terms = ''
    }
  }
)

watch(
  () => user.value.name,
  (value) => {
    if (!value) {
      errors.value.name = 'Please enter your name'
    } else {
      errors.value.name = ''
    }
  }
)
</script>

<template>
  <main>
    <div class="form-content signs-up">
      <v-card cariant="flat" elevation="0" height="100%">
        <v-form>
          <v-card-title>
            <h2>Sign Up</h2>
          </v-card-title>
          <div class="socials-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
          <span>or use your email for registeration</span>
          <input v-model="user.name" type="text" placeholder="Name" required />
          <div>
            <span class="tw-text-red-700" v-if="errors.email">{{ errors.email }}</span>
          </div>
          <input v-model="user.email" type="email" placeholder="Email" required />
          <div>
            <span class="tw-text-red-700" v-if="errors.email">{{ errors.email }}</span>
          </div>
          <input v-model="user.birthdate" type="date" placeholder="birthday" required />
          <div>
            <span class="tw-text-red-700" v-if="errors.birthdate">{{ errors.birthdate }}</span>
          </div>
          <input v-model="user.password" type="password" placeholder="Password" required />
          <div>
            <span class="tw-text-red-700" v-if="errors.password">{{ errors.password }}</span>
          </div>
          <input
            v-model="user.password_confirm"
            type="password"
            placeholder="Repeat Password"
            required
          />
          <div>
            <span class="tw-text-red-700" v-if="errors.password_confirm">{{
              errors.password_confirm
            }}</span>
          </div>
          <v-btn :disabled="false" @click="register">Sign Up</v-btn>
        </v-form>
      </v-card>
    </div>
  </main>
</template>

<style scoped></style>
