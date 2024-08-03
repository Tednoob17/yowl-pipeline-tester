<script setup>
import RegisterForm from '@/components/forms/RegisterForm.vue'
import '@/assets/css/login.css'
</script>
<template>
  <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-h-screen">
    <div class="content" id="content">
      <register-form></register-form>
      <div class="bubble-content">
        <div class="bubble">
          <div class="bubble-panel bubble-right">
            <div>
              <div class="text-h4 text-center">
                <strong>Welcome Back!</strong>
              </div>
            </div>
            <p>Enter your personal details to use all of site features</p>
            <button class="hidden" id="login">Sign In</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped></style>
