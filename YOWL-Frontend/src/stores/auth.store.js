import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { authService } from '@/services/auth.service'

export const useAuthStore = defineStore('auth', () => {
  const serve = authService()
  const user = ref(null)

  const isLoggedIn = computed(() => !!user.value)

  const getUserName = computed(() => user.value?.name)

  const getUserEmail = computed(() => user.value?.email)

  const getUserBirthdate = computed(() => user.value?.birthdate)

  function initAuth() {
    const local_user = localStorage.getItem('user')
    if (!!local_user) {
      user.value = JSON.parse(local_user)
    }
  }

  async function login(credentials) {
    user.value = (await serve.login(credentials)).data
    localStorage.setItem('user', JSON.stringify(user.value))
    localStorage.setItem('token', user.value.data.access_token)
    return user.value
  }

  async function register(credentials) {
    const result = (await serve.register(credentials)).data
    localStorage.setItem('user', JSON.stringify(result))
    user.value = result
    localStorage.setItem('token', user.value.data.access_token)
    return user.value
  }

  async function logout() {
    await serve.logout()
    localStorage.removeItem('user')
    user.value = null
  }

  async function veryfymail(email) {
    return (await serve.veryfymail(email)).data
  }

  return {
    user,
    isLoggedIn,
    getUserName,
    getUserEmail,
    getUserBirthdate,
    initAuth,
    login,
    register,
    logout
  }
})
