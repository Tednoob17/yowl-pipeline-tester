import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { authService } from '@/services/auth.service'

export const useAuthStore = defineStore('auth', () => {
  const serve = authService()
  const user = ref({})

  const isLoggedIn = computed(() => !!user.value)

  const getUserName = computed(() => user.value?.name)

  const getUserEmail = computed(() => user.value?.email)

  const getUserBirthdate = computed(() => user.value?.birthdate)

  async function initAuth() {
    return await serve.current().then((response) => {
      return user.value = response.data
    })
  }

  async function login(credentials) {
    return await serve
      .login(credentials)
      .then((response) => {
        user.value = response.data
        localStorage.setItem('user', JSON.stringify(user.value))
        localStorage.setItem('token', user.value.data.access_token)
      })
      .then(() => {
        return true
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function updateUser(user) {
    await serve
      .updateUser(user)
      .then(() => {
        localStorage.setItem('user', JSON.stringify(user.value))
      })
      .then(() => {
        return true
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function updatePassword(passwords) {
    await serve.updatePassword(passwords)
  }

  async function register(credentials) {
    await serve
      .register(credentials)
      .then((response) => {
        user.value = response.data
        localStorage.setItem('user', JSON.stringify(user.value))
        localStorage.setItem('token', user.value.data.access_token)
      })
      .then(() => {
        return true
      })
      .catch((error) => {
        console.error(error)
      })
  }

  async function logout() {
    await serve.logout()
    localStorage.removeItem('user')
    localStorage.removeItem('token')
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
    updatePassword,
    updateUser,
    veryfymail,
    initAuth,
    login,
    register,
    logout
  }
})
