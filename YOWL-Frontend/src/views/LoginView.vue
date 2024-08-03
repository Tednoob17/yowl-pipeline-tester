<script setup>
import LoginForm from '@/components/forms/LoginForm.vue'
import '@/assets/css/login.css'
</script>

<template>
  <div class="tw-flex tw-items-center tw-justify-center tw-h-screen">
    <div class="container" id="container">
      <login-form></login-form>

      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-right">
            <div class="text-h4 text-center">
              <strong>Hello, Friend!</strong>
            </div>
            <p>Register with your personal details to use all of site features</p>
            <button class="hidden" id="register">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
