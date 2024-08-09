import Axios from 'axios'
import { useRouter } from 'vue-router'
import { toast } from 'vuetify-sonner'

export function baseService() {
  const baseURL = import.meta.env.VITE_API_URL ?? 'http://localhost:8000/api/'

  const router = useRouter()

  let token = localStorage.getItem('token') ?? null

  const axios = Axios.create({
    baseURL: baseURL,
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json'
    }
  })

  if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
  }

  axios.interceptors.request.use(
    (config) => {
      const token = localStorage.getItem('token')
      if (token) {
        config.headers['Authorization'] = `Bearer ${token}`
      }
      return config
    },
    (error) => {
      return Promise.reject(error)
    }
  )

  axios.interceptors.response.use(
    (response) => {
      if (response.data.message) {
        toast(response.data.message, 'success')
      }
      return response
    },
    (error) => {
      if (error.response.status === 401) {
        localStorage.removeItem('token')
        toast.error("Unauthorized");
        // router.push('/login')
      }
      else if (error.response.status === 403) {
        toast.error('You are not authorized to access this resource')
      }
      else if (error.response.status === 404) {
        router.push('/not-found')
      }
      else if (error.response.status === 422) {
        toast.error("Please retry")
      }
      else {
        toast.error("An error occur")
      }
      return Promise.reject(error)
    }
  )

  return axios
}
