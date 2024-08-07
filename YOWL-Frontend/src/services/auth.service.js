import { baseService } from './base.service'

export function authService() {
  const axios = baseService()

  // get current user
  async function current() {
    return axios.get('/user')
  }

  async function login(credentials) {
    return axios.post('/login', credentials)
  }

  async function register(credentials) {
    return axios.post('/register', credentials)
  }

  async function updateUser(user) {
    return axios.put('/update-profile', user).then((response) => {
      localStorage.setItem('user', JSON.stringify(response.data))
    })
  }

  async function updatePassword(old, password) {
    return axios.post('/update-password', { old: old, password: password })
  }

  async function logout() {
    return axios.post('/logout')
  }

  async function enablefa(value) {
    return axios.post('/enablefa', { value: value })
  }

  async function removeAccount() {
    return axios.delete('/delete-profile')
  }

  return {
    removeAccount,
    updatePassword,
    axios,
    enablefa,
    current,
    login,
    updateUser,
    register,
    logout
  }
}
