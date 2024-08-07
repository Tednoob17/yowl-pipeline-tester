<script setup>
import { ref, watch, computed } from 'vue'
import { useAuthStore } from '@/stores/auth.store'
import { useRouter } from 'vue-router';
import '@/assets/css/signin.css'

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

const signin = () => {
  if (isValid) {
    authStore
      .signin(user.value)
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

            <v-form>
                <!-- Form Container -->
                <div class="form-container">
                    <div class="col col-1">
                        <div class="image-layer">
                            <img src="@/assets/img/white-outline.png" class="form-image-main">
                            <img src="@/assets/img/pandas_1.png" class="form-image pandas">

                        </div>
                        <p class="featured-words">Register with your <span>personal details</span> use all of site
                            features.</p>
                    </div>

                    <div class="col col-2">

                        <!-- Login Form Container -->
                        <div class="login-form">
                            <div class="form-title">
                                <span>Sign In</span>
                            </div>

                            <div>
                                <div class="login__inputs">
                                    <div>
                                        <label for="input-email" class="login__label">Email</label>

                                        <div class="login__box">
                                            <input type="email" v-model="user.email"
                                                placeholder="Enter your email address" required class="login__input"
                                                id="input-email">
                                            <i class="bx bx-envelope login__eye icon"></i>
                                        </div>
                                        <div>
                                            <span class="tw-text-red-700" v-if="errors.email">{{ errors.email }}</span>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="input-pass" class="login__label">Password</label>

                                        <div class="login__box">
                                            <input type="password" v-model="user.password"
                                                placeholder="Enter your password" required class="login__input"
                                                id="input-pass">
                                            <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                                        </div>
                                        <div>
                                            <span class="tw-text-red-700" v-if="errors.password">{{ errors.password
                                                }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="login__check">
                                    <input type="checkbox" class="login__check-input" id="input-check">
                                    <label for="input-check" class="login__check-label">Remember me</label>
                                </div>

                                <div class="input-box">
                                    <button :disabled="!isValid" @click="signin" class="input-submit">
                                        <span>Sign In</span>
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

                            <div class="input-box">
                                <p>Not a Member</p>
                                <button class="input-submit">
                                    <a href="/signup">
                                        <span>Sign Up</span>
                                    </a>
                                    <i class="bx bx-right-arrow-alt"> </i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </v-form>

</template>