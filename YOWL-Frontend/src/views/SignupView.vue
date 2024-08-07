

<script setup>
import { ref, watch, computed } from 'vue'
import { useAuthStore } from '@/stores/auth.store'
import { useRouter } from 'vue-router'
// import '@/assets/css/signup.css'

const authStore = useAuthStore()

const user = ref({
  name: '',
  email: '',
  password: '',
  password_confirm: '',
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

const signup = () => {
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
);
</script>


<template>
    <v-form>
        <!-- Form Container -->
        <div class="form-container">
            <div class="col col-3">
                <div class="image-layer">
                    <img src="@/assets/img/white-outline.png" class="form-image-main">
                    <img src="@/assets/img/pandas_1.png" class="form-image pandas">

                </div>
                <p class="featured-words">Enter your <span>personal details</span> to use all of site features. </p>
            </div>

            <div class="col col-4">

                <!-- Register Form Container -->
                <div class="register-form">
                    <div class="form-title">
                        <span>Create Account</span>
                    </div>

                    <div>
                        <div class="login__inputs">

                            <div>
                                <label for="input-pass" class="login__label">Name</label>

                                <div class="login__box">
                                    <input type="text" v-model="user.name" placeholder="name" required
                                        class="login__input" id="input-pass">
                                    <i class="bx bx-user login__eye icon" id="input-icon"></i>
                                </div>
                                <div>
                                    <span class="tw-text-red-700" v-if="errors.name">{{ errors.name }}</span>
                                </div>
                            </div>

                            <div>
                                <label for="input-email" class="login__label">Email</label>

                                <div class="login__box">
                                    <input type="email" v-model="user.email" placeholder="Enter your email address"
                                        required class="login__input" id="input-email">
                                    <i class="bx bx-envelope login__eye icon"></i>
                                </div>
                                <div>
                                    <span class="tw-text-red-700" v-if="errors.email">{{ errors.email }}</span>
                                </div>
                            </div>

                            <div>
                                <label for="input-pass" class="login__label">Password</label>

                                <div class="login__box">
                                    <input type="password" v-model="user.password" placeholder="Enter your password"
                                        required class="login__input" id="input-pass">
                                    <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                                </div>
                                <div>
                                    <span class="tw-text-red-700" v-if="errors.password">{{ errors.password }}</span>
                                </div>
                            </div>

                            <div>
                                <label for="input-pass" class="login__label">Confirm Password</label>

                                <div class="login__box">
                                    <input type="password" v-model="user.password_confirm" placeholder="Repeat password"
                                        required class="login__input" id="input-pass">
                                    <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                                </div>

                                <div>
                                    <span class="tw-text-red-700" v-if="errors.password_confirm">{{
                                        errors.password_confirm
                                        }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="input-box">
                            <button :disabled="false" @click="signup" class="input-submit">
                                <span>Sign Up</span>
                                <i class="bx bx-right-arrow-alt"> </i>
                            </button>
                        </div>
                    </div>
                    <div class="social-login">
                        <i class="bx bxl-google"></i>
                        <i class="bx bxl-facebook"></i>
                        <i class="bx bxl-twitter"></i>
                        <i class="bx bxl-github"></i>
                    </div>
                </div>
            </div>
        </div>
    </v-form>
</template>