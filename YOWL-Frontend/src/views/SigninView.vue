<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth.store'
import { toast } from 'vuetify-sonner'

const authStore = useAuthStore()
const loginForm = ref(null)
const signupForm = ref(null)
const showPassword = ref(false)
const login_tabs = ref('login')
const user = ref({
  login: {
    email: '',
    password: ''
  },
  signup: {
    name: '',
    email: '',
    password: '',
    password_confirm: '',
    birthdate: '',
    terms: false
  }
})

const rules = {
  required: (value) => !!value || 'Required.',
  birthdate: (value) => {
    return (value && new Date(value) < new Date()) || 'Invalid birthdate.'
  },
  email: (value) => {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return pattern.test(value) || 'Invalid e-mail.'
  },
  password: (value) => {
    if (value.length < 8) {
      return 'Password must be at least 8 characters long.'
    }
    return true
  },
  password_comfirm: (value) => {
    if (value !== user.value.signup.password) {
      return 'Passwords do not match.'
    }
    return true
  }
}

const router = useRouter()

const errors = ref({
  email: '',
  password: ''
})

const login = async () => {
  await loginForm.value.validate().then(() => {
    if (!loginForm) {
      console.log(loginForm.value.valid)
    } else {
      authStore
        .login(user.value.login)
        .then(() => {
          router.push('/')
        })
        .catch((error) => {
          toast.error(error.response.data.message)

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
          } else {
            errors.value.email = 'Something went wrong'
          }
        })
    }
  })
}

const signup = async () => {
  await signupForm.value.validate().then((res) => {
    if (!signupForm) {
      return
    } else {
      authStore
        .register(user.value.signup)
        .then(() => {
          router.push('/')
        })
        .catch((error) => {
          console.log(error)
        })
    }
  })
}
</script>

<template>
  <div class="root">
    <div class="tw-flex tw-h-[90vh] tw-w-[90%] tw-my-auto tw-backdrop-blur-lg">
      <div
        class="tw-h-full tw-hidden md:tw-flex tw-w-1/2 tw-backdrop-blur-xl tw-rounded-tr-[100px] tw-rounded-br-[100px] p-5 tw-flex-col tw-items-center tw-justify-center"
      >
        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center">
          <img
            class="tw-z-10"
            width="250px"
            height="250px"
            src="../assets/img/pandas_1.png"
            alt=""
          />
          <img
            class="tw-bg-transparent tw-absolute"
            width="300px"
            height="300px"
            src="../assets/img/white-outline.png"
            alt="image"
          />
        </div>
        <div class="tw-w-5/6 text-center mt-8">
          <span>No one enters unless</span> <span class="tw-text-blue-500">He</span> or
          <span class="tw-text-blue-500">She</span> is Registered .
        </div>
      </div>
      <div class="tw-p-5 tw-grid md:tw-w-1/2 tw-w-full">
        <div class="tw-flex tw-w-full tw-justify-center">
          <v-tabs v-model="login_tabs">
            <v-tab
              value="login"
              selected-class="bg-black"
              class="pa-4 tw-transition-all tw-duration-700 tw-ease-out tw-mx-2"
              rounded="xl"
            >
              Sign In
            </v-tab>
            <v-tab
              value="signup"
              selected-class="bg-black"
              class="pa-4 tw-transition-all tw-duration-700 tw-ease-out tw-mx-2"
              rounded="xl"
            >
              Sign Up
            </v-tab>
          </v-tabs>
        </div>
        <div class="tw-w-full">
          <v-tabs-window v-model="login_tabs">
            <v-tabs-window-item value="login">
              <v-form class="mx-auto" ref="loginForm">
                <v-text-field
                  v-model="user.login.email"
                  label="Email"
                  :rules="[rules.required, rules.email]"
                  type="email"
                  required
                ></v-text-field>
                <div>
                  <span class="tw-text-red-700" v-if="errors.email">{{ errors.email }}</span>
                </div>
                <v-text-field
                  v-model="user.login.password"
                  label="Password"
                  :rules="[rules.required]"
                  :type="showPassword ? 'text' : 'password'"
                  required
                >
                  <template #append-inner>
                    <v-btn
                      variant="icon"
                      :icon="!showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                      @click="showPassword = !showPassword"
                    >
                    </v-btn>
                  </template>
                </v-text-field>
                <div>
                  <span class="tw-text-red-700" v-if="errors.password">{{ errors.password }}</span>
                </div>
                <v-btn
                  append-icon="mdi-arrow-right"
                  class="tw-mt-4"
                  variant="outlined"
                  block
                  @click="login"
                >
                  Sign In
                </v-btn>
              </v-form>
            </v-tabs-window-item>
            <v-tabs-window-item value="signup">
              <v-form class="mx-auto" ref="signupForm">
                <v-text-field
                  v-model="user.signup.name"
                  :rules="[rules.required]"
                  label="Name"
                  type="text"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="user.signup.email"
                  :rules="[rules.required, rules.email]"
                  label="Email"
                  type="email"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="user.signup.birthdate"
                  :rules="[rules.required, rules.birthdate]"
                  label="Birthdate"
                  type="date"
                  required
                ></v-text-field>
                <v-text-field
                  v-model="user.signup.password"
                  :rules="[rules.required, rules.password]"
                  label="Password"
                  :type="showPassword ? 'text' : 'password'"
                  required
                >
                  <template #append-inner>
                    <v-btn
                      variant="plain"
                      :icon="!showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                      @click="showPassword = !showPassword"
                    >
                    </v-btn>
                  </template>
                </v-text-field>
                <v-text-field
                  v-model="user.signup.password_confirm"
                  label="Confirm Password"
                  :type="showPassword ? 'text' : 'password'"
                  required
                >
                </v-text-field>
                <v-checkbox
                  v-model="user.signup.terms"
                  label="I agree to the terms and conditions"
                  required
                ></v-checkbox>
                <v-btn
                  append-icon="mdi-arrow-right"
                  class="tw-mt-4"
                  variant="outlined"
                  block
                  @click="signup"
                >
                  Sign Up
                </v-btn>
              </v-form>
            </v-tabs-window-item>
          </v-tabs-window>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.root {
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url('../assets/img/bg-login.png');
  background-size: cover;
  height: 100vh;
  background-color: #f5f5f5;
}
</style>
