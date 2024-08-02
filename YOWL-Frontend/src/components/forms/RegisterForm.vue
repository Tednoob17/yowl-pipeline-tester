<!-- <script setup>
import { ref } from 'vue'

const user = ref({
  email: '',
  password: '',
  terms: ''
})

const showed = ref(false)

function show_password() {
  showed.value = !showed.value
}

function submit() {
  alert('Nexus')
}
</script>

<template>
  <v-form
    validate-on="submit lazy"
    @submit.prevent="submit"
    class="tw-max-w-lg tw-space-y-5 tw-max-md:tw-mx-auto tw-w-full tw-p-6"
  >
    <div class="tw-mb-12">
      <h3 class="tw-text-gray-800 tw-text-4xl font-extrabold">Sign in</h3>
    </div>

    <v-text-field
      label="Email"
      v-model="user.email"
      placeholder="Enter email"
      type="text"
      append-inner-icon="mdi-email"
      variant="outlined"
      required
      rules=""
    >
    </v-text-field>
    <v-text-field
      label="Password"
      v-model="user.password"
      placeholder="Enter password"
      :type="!showed ? 'text' : 'password'"
      variant="outlined"
      required
      rules=""
    >
      <template #append-inner>
        <v-btn
          @click="show_password"
          variant="flat"
          :icon="!showed ? 'mdi-eye-closed' : 'mdi-eye'"
        ></v-btn>
      </template>
    </v-text-field>

    <div class="tw-flex tw-justify-between">
      <v-checkbox class="tw-h-fit"  v-model="user.terms" label="Conditions d'utilisation"></v-checkbox>
      <v-btn color="primary" class="tw-mt-[10px] text-capitalize"  variant="text" to="/">Forgot password</v-btn>
    </div>

    <div class="tw-mt-8">
      <button
        type="submit"
        class="tw-w-full tw-shadow-xl tw-py-3 tw-px-6 tw-text-sm tw-tracking-wide tw-font-semibold tw-rounded-md text-white tw-bg-blue-600 hover:tw-bg-blue-700 focus:tw-outline-none"
      >
        Log in
      </button>
    </div>
    <p class="tw-text-sm tw-mt-8 tw-text-center tw-text-gray-800">
      Don't have an account?
      <a
        href="javascript:void(0);"
        class="tw-text-blue-600 tw-font-semibold tw-tracking-wide hover:tw-underline tw-ml-1"
        >Register here</a
      >
    </p>
  </v-form>
</template> -->

<script setup>
</script>


<template>
  <main>
    <div class="form-content signs-up">
      <form>
        <h1>Create Account</h1>
        <div class="socials-icons">
          <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
          <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
        <span>or use your email for registeration</span>
        <input type="text" placeholder="Name" required>
        <input type="email" placeholder="Email" required>
        <input type="date" placeholder="birthday" required>
        <input type="password" placeholder="Password" required>
        <input type="password" placeholder="Repeat Password" required>
        <button>Sign Up</button>
      </form>
    </div>
  </main>
</template>

<style scoped></style>