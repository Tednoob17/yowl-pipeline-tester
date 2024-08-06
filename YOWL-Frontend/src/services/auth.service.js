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

  async function updatePassword(passwords) {
    return axios.put('/update-password', passwords)
  }

  async function logout() {
    return axios.post('/logout')
  }

  return {
    updatePassword,
    current,
    login,
    updateUser,
    register,
    logout
  }
}
