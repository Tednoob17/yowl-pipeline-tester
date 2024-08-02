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
      if (error.response.status === 401) {
        localStorage.removeItem('token')
        toast("Vous n'aurez pas accès à cette page, veuillez vous connecter", {
          cardProps: {
            color: 'error'
          }
        })
        if (router.currentRoute.value.name !== 'login') {
          router.push({ name: 'login' })
        }
      } else if (error.response.status === 404) {
        toast("La ressource demandée n'existe pas", {
          cardProps: {
            color: 'error'
          }
        })
        router.push({ name: 'home' })
      } else if (error.response.status === 422) {
        toast('Veuillez vérifier les champs', {
          cardProps: {
            color: 'error'
          }
        })
      } else if (error.response.status === 403) {
        if (router.currentRoute.value.name !== 'login') {
          toast("Vous n'avez pas les droits pour accéder à cette page", {
            cardProps: {
              color: 'error'
            }
          })
        } else {
          toast('Accès incorrect', {
            cardProps: {
              color: 'error'
            }
          })
        }

        if (router.currentRoute.value.name !== 'login') {
          router.push({ name: 'login' })
        }
      } else if (error.response.status === 410) {
        toast('Vous ne pouvez pas accéder à cette ressource.', {
          cardProps: {
            color: 'error'
          }
        })
        router.push({ name: 'login' })
      } else {
        toast('Une erreur est survenue', {
          cardProps: {
            color: 'error'
          }
        })
        return Promise.reject(error)
      }
    }
  )

  return axios
}
