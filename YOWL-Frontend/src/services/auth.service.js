import { baseService } from './base.service'

export function authService() {
  const axios = baseService()

  async function login(credentials) {
    return axios.post('/login', credentials)
  }

  async function register(credentials) {
    return axios.post('/register', credentials)
  }

  async function logout() {
    return axios.post('/logout')
  }
  
  return {
    login,
    register,
    logout
  }
}
