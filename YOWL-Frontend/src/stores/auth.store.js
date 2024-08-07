import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { authService } from '@/services/auth.service'

export const useAuthStore = defineStore('auth', () => {
  const serve = authService()
  const user = ref({})
  const authenticated = ref(false)

  const isLoggedIn = computed(() => !!user.value)

  const getUserName = computed(() => user.value?.name)

  const getUserEmail = computed(() => user.value?.email)

  const getUserBirthdate = computed(() => user.value?.birthdate)

  async function initAuth() {
    return await serve.current().then((response) => {
      authenticated.value = true
      user.value = response.data
      localStorage.setItem('user', JSON.stringify(user.value))
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
      .then(async () => {
        serve.axios.defaults.headers.common['Authorization'] =
          `Bearer ${user.value.data.access_token}`
        // get user data
        await initAuth()
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

  async function updatePassword(old, newpass) {
    await serve.updatePassword(old, newpass)
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

  async function enablefa(value) {
    return (await serve.enablefa(value)).data
  }

  async function removeAccount() {
    return (await serve.removeAccount()).data
  }

  return {
    user,
    authenticated,
    removeAccount,
    isLoggedIn,
    enablefa,
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
