<script setup>
import HeaderBar from '@/components/bars/HeaderBar.vue'
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth.store'
import { toast } from 'vuetify-sonner'
import { useRouter } from 'vue-router'

const router = useRouter()
const enablefa = ref(false)
const loading = ref(false)
const authStore = useAuthStore()

const password = ref({
  old: '',
  new: '',
  confirm: ''
})

function init() {
  loading.value = true
  authStore.initAuth().then(() => {
    loading.value = false
    console.log(authStore.user)
  })
}

function enableThefa() {
  authStore.enablefa(enablefa.value).then(() => {
    toast.success('2FA updated successfully')
  })
}

init()

const logout = () => {
  authStore.logout().then(() => {
    router.push({ name: 'login' })
  })
}

function updatePassword() {
  if (password.value.old === '') {
    toast.error('Old password is required')
    return
  }

  const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/
  if (!passwordRegex.test(password.value.new)) {
    toast.error(
      'Password must contain at least 8 characters, one uppercase letter, one lowercase letter, and one number'
    )
    return
  }

  if (password.value.new !== password.value.confirm) {
    toast.error('Passwords do not match')
    return
  }
  authStore
    .updatePassword(password.value.old, password.value.new)
    .then(() => {
      toast.success('Password updated successfully')
    })
    .catch(() => {
      toast.error('An error occurred while updating the password')
    })
}

function update() {
  authStore
    .updateUser({
      name: authStore.user.name,
      email: authStore.user.email
    })
    .then(() => {
      toast.success('User updated successfully')
    })
    .catch(() => {
      toast.error('An error occurred while updating the user')
    })
}

function deleteAccount() {
  if (confirm('Are you sure you want to delete your account?')) {
    authStore
      .removeAccount()
      .then(() => {
        toast.success('User deleted successfully')
        router.push({ name: 'login' })
      })
      .catch(() => {
        toast.error('An error occurred while deleting the user')
      })
  }
}
</script>

<template>
  <div v-if="loading" class="tw-flex tw-justify-between tw-h-screen tw-flex-col tw-items-center">
    <div class="tw-animate-spin tw-bg-blue-800 tw-h-2 tw-w-2"></div>
  </div>
  <div v-else>
    <header-bar></header-bar>
    <main class="tw-bg-white tw-p-5">
      <div class="tw-flex tw-border-b tw-border-b-black">
        <div class="tw-w-[25%] tw-px-4 tw-hidden md:tw-block">
          <h1 class="tw-mt-4 tw-text-slate-800 tw-font-bold tw-text-lg">Personnal Information</h1>
          <p class="tw-text-slate-600 tw-text-md tw-text-justify">
            This section allows you to change your personal account information. Use a permanent
            address where you can receive mail.
          </p>
        </div>
        <div class="md:tw-w-[75%] tw-w-full">
          <div class="md:tw-flex">
            <img
              class="tw-h-20 tw-rounded-lg tw-mt-4 tw-mx-4"
              :src="authStore.user.profile_photo_url"
              alt=""
            />
            <div class="tw-mt-6">
              <button
                class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-p-2 tw-m-2 tw-text-white tw-bg-blue-800"
              >
                Change the avatar
              </button>
              <p class="tw-text-slate-800 tw-font-bold tw-text-sm">JPG, GIF or PNG. 1MB max.</p>
            </div>
            <div class="tw-mt-6 tw-ml-8">
              <button
                @click="logout"
                class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2"
              >
                Logout
              </button>
            </div>
          </div>
          <div>
            <div class="tw-flex">
              <div class="tw-mt-4 tw-pr-4 tw-w-full">
                <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for=""
                  >Username</label
                >
                <input
                  v-model="authStore.user.name"
                  class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]"
                  type="text"
                  required
                />
              </div>
            </div>
            <div class="tw-mt-4 tw-pr-4 tw-w-full">
              <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for=""
                >Email adress</label
              >
              <input
                v-model="authStore.user.email"
                class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]"
                type="email"
                required
              />
            </div>
            <button
              @click="update"
              class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2"
            >
              Save change
            </button>
          </div>
        </div>
      </div>
      <div class="tw-flex tw-border-b tw-border-b-black">
        <div class="tw-w-[25%] tw-px-4 tw-hidden md:tw-block">
          <h1 class="tw-mt-4 tw-text-slate-800 tw-font-bold tw-text-lg">Password update</h1>
          <p class="tw-text-slate-600 tw-text-md tw-text-justify">
            Change your password. For the security of your account, it is recommended to use a
            strong password containing at least 8 characters.
          </p>
        </div>
        <div class="md:tw-w-[75%] tw-w-full">
          <div>
            <div class="tw-mt-4 tw-pr-4">
              <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for=""
                >Old password</label
              >
              <input
                v-model="password.old"
                class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]"
                type="password"
                required
              />
            </div>
            <div class="tw-grid">
              <div class="tw-mt-4 tw-pr-4 md:tw-w-1/2 tw-min-w-full">
                <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for=""
                  >New password</label
                >
                <input
                  v-model="password.new"
                  class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]"
                  type="password"
                  required
                />
              </div>
              <div class="tw-mt-4 tw-pr-4 md:tw-w-1/2 tw-min-w-full">
                <label class="tw-w-full tw-text-slate-800 tw-text-lg tw-mx-2 tw-font-bold" for=""
                  >New password confirmation</label
                >
                <input
                  v-model="password.confirm"
                  class="tw-mx-2 tw-px-2 tw-text-black tw-w-full tw-rounded-md tw-text-md tw-py-2 tw-my-2 focus:tw-outline-blue-800 tw-bg-[#dee2e6]"
                  type="password"
                  required
                />
              </div>
            </div>
            <button
              @click="updatePassword"
              class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2"
            >
              Update
            </button>
          </div>
        </div>
      </div>
      <div class="tw-flex tw-border-b tw-border-b-black">
        <div class="tw-w-[25%] tw-px-4 tw-hidden md:tw-block">
          <h1 class="tw-mt-4 tw-text-slate-800 tw-font-bold tw-text-lg">Preferences</h1>
          <p class="tw-text-slate-600 tw-text-md tw-text-justify">Add your preferences here.</p>
        </div>
        <div class="md:tw-w-[75%] tw-w-full">
          <div>
            <div class="tw-mt-4 tw-pr-4 tw-flex">
              <label
                class="checkbox tw-text-slate-800 tw-text-lg tw-mx-2 tw-my-auto tw-font-bold"
                for=""
                >Enable or disable 2FA</label
              >
              <div class="tw-pt-2">
                <input
                  v-model="enablefa"
                  class="tw-h-6 tw-w-6 tw-my-auto"
                  type="checkbox"
                  id="checkbox"
                />
              </div>
            </div>
            <button
              @click="enableThefa"
              class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-m-2 tw-text-white tw-bg-blue-800 tw-px-4 tw-text-ml tw-p-2"
            >
              Update
            </button>
          </div>
        </div>
      </div>
      <div class="tw-grid tw-justify-center">
        <div class="place-self-end">
          <button
            @click="deleteAccount"
            class="hover:tw-bg-blue-400 tw-rounded-md tw-font-bold tw-m-2 tw-text-white tw-bg-red-600 tw-px-4 tw-text-ml tw-p-2"
          >
            Delete my account
          </button>
        </div>
      </div>
    </main>
  </div>
</template>
