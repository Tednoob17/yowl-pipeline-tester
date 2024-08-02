import { baseService } from "./base.service";

export function authService() {
    const { axios } = baseService()
    
    const login = async (credentials) => {
        return axios.post('/login', credentials)
    }
    
    const register = async (credentials) => {
        return axios.post('/register', credentials)
    }
    
    return {
        login,
        register
    }
}