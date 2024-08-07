<script setup>
import { ref, watch, computed } from 'vue'
import { useAuthStore } from '@/stores/auth.store'
import { useRouter } from 'vue-router';

const authStore = useAuthStore()

const user = ref({
  email: '',
  password: ''
})

const errors = ref({
  email: '',
  password: ''
})

const isValid = computed(() => {
  return !errors.value.email && !errors.value.password
})

const router = useRouter()

const login = () => {
  if (isValid) {
    authStore
      .login(user.value)
      .then(() => {
        router.push('/')
      })
      .catch((error) => {
        if (error.response) {
          errors.value.email = error?.response.data.email
            ? error.response.data.email.join('</br>')
            : ''
          errors.value.password = error?.response.data.password
            ? error.response.data.password.join('</br>')
            : ''
          if (!errors.value.email && !errors.value.password) {
            errors.value.email = error.response.data.message
          }
        }
        else {
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
);
</script>

<template>
  <main>
    <v-card variant="flat" class="form-container sign-in">
      <v-card-text>
        <v-form>
          <div>
            <div class="text-h4 text-center">
              <strong>Sign In</strong>
            </div>
          </div>
          <div class="tw-inline-flex tw-justify-center tw-w-full social-icons">
            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
          </div>
          <div class="tw-text-center">
            <span>or use your email password</span>
          </div>
          <input v-model="user.email" type="email" placeholder="Email" required />
          <div>
            <span class="tw-text-red-700" v-if="errors.email">{{ errors.email }}</span>
          </div>
          <input v-model="user.password" type="password" placeholder="Password" required />
          <div>
            <span class="tw-text-red-700" v-if="errors.password">{{ errors.password }}</span>
          </div>
          <div class="tw-flex tw-justify-between">
            <v-btn :disabled="!isValid" @click="login"> Sign In </v-btn>
          </div>
        </v-form>
      </v-card-text>
    </v-card>
</main>
</template>
