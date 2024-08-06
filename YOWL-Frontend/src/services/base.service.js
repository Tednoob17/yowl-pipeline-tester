import Axios from 'axios'
import { useRouter} from 'vue-router'
import { toast } from 'vuetify-sonner'

export function baseService() {
  const baseURL = import.meta.env.VITE_API_URL ?? 'http://localhost:8000/api/'

  const router = useRouter()

  let token = localStorage.getItem('token') ?? null

  const axios = Axios.create({
    baseURL: baseURL,
    headers: {
      'Content-Type': 'multipart/form-data',
      Accept: 'application/json'
    }
  })

  if (token) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
  }

  axios.interceptors.request.use(
    (config) => {
      return config
    },
    (error) => {
      return Promise.reject(error)
    }
  )

  axios.interceptors.response.use(
    (response) => {
      return response
    },
    (error) => {
      return Promise.reject(error)
    }
  )

  return axios
}
