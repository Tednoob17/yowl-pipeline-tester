<script setup>
import RegisterForm from '@/components/forms/RegisterForm.vue';
</script>

<!-- <template>
  <div class="tw-w-font-[sans-serif] tw-max-w-7xl tw-mx-auto tw-h-screen">
    <div class="tw-grid md:tw-grid-cols-2 tw-items-center tw-gap-8 tw-h-full">
      <login-form>
      </login-form>

      <div
        class="tw-h-full md:tw-py-6 tw-items-center tw-relative max-md:before:tw-hidden sm:tw-flex tw-hidden before:tw-absolute before:tw-bg-gradient-to-r before:tw-from-gray-50 before:tw-via-[#E4FE66] before:tw-to-[#55F5A3] before:tw-h-full before:tw-w-3/4 before:tw-right-0 before:tw-z-0 tw-w-full"
      >
        <img
          src="https://readymadeui.com/photo.webp"
          class="tw-rounded-md lg:tw-w-4/5 md:w-11/12 tw-z-50 tw-relative"
          alt="Dining Experience"
        />before
      </div>
    </div>
  </div>
</template> -->

<template>
  <div class="content" id="content">
    <register-form></register-form>
    <div class="bubble-content">
      <div class="bubble">
        <div class="bubble-panel bubble-right">
          <h1>Welcome Back!</h1>
          <p>Enter your personal details to use all of site features</p>
          <button class="hidden" id="login">Sign In</button>
        </div>
        <!-- <div class="toggle-panel toggle-right">
        <h1>Hello, Friend!</h1>
        <p>Register with your personal details to use all of site features</p>
        <button class="hidden" id="register">Sign Up</button>
            </div> -->
      </div>
    </div>
  </div>
</template>

<style scoped></style>
