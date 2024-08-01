<script setup>
import LoginForm from '@/components/forms/LoginForm.vue';
</script>

<template>
  <div class="tw-w-font-[sans-serif] tw-max-w-7xl tw-mx-auto tw-h-screen">
    <div class="tw-grid md:tw-grid-cols-2 tw-items-center tw-gap-8 tw-h-full">
      <login-form>
      </login-form>

      <div
        class="tw-h-full md:tw-py-6 tw-items-center tw-relative max-md:before:tw-hidden sm:tw-flex tw-hidden before:tw-absolute before:tw-bg-gradient-to-r before:tw-from-gray-50 before:tw-via-[#E4FE66] before:tw-to-[#55F5A3] before:tw-h-full before:tw-w-3/4 before:tw-right-0 before:tw-z-0"
      >
        <img
          src="https://readymadeui.com/photo.webp"
          class="tw-rounded-md lg:tw-w-4/5 md:w-11/12 tw-z-50 tw-relative"
          alt="Dining Experience"
        />before
      </div>
    </div>
  </div>
</template>
