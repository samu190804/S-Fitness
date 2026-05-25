import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { initCsrf, getCookie } from '@/services/cookiesCSRF'

interface User {
    CodU: number
    Name: string
    UserName: string
    Email: string
    admin: boolean
    Img: string | null
}

interface LoginCredentials {
    email: string
    password: string
}

interface UpdateUserParams {
    name: string
    userName: string
    email: string
    password: string
}

export const useAuthStore = defineStore('auth', () => {
    const user = ref<User | null>(null)
    const ready = ref(false)

    const isAuthenticated = computed(() => !!user.value)
    const isAdmin = computed(() => user.value?.admin ?? false)

    async function fetchUser(): Promise<void> {
        try {
            const res = await fetch('/api/me', {
                method: 'GET',
                credentials: 'include',
                headers: { 'Accept': 'application/json' }
            })
            const json = await res.json()
            if (json.success) {
                user.value = json.data
            } else {
                user.value = null
            }
        } catch {
            user.value = null
        } finally {
            ready.value = true
        }
    }

    async function login(credentials: LoginCredentials): Promise<{ success: boolean; message?: string }> {
        await initCsrf()
        const xsrfToken = getCookie('XSRF-TOKEN')
        const res = await fetch('/api/login', {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-XSRF-TOKEN': xsrfToken
            },
            body: JSON.stringify(credentials)
        })
        const json = await res.json()
        if (json.success) {
            user.value = json.data.user
        }
        return json
    }

    async function logout(): Promise<void> {
        await fetch('/api/logout', {
            method: 'POST',
            credentials: 'include',
            headers: { 'Accept': 'application/json' }
        })
        user.value = null
    }

    async function updateUser(params: UpdateUserParams): Promise<{ success: boolean; message?: string }> {
        const xsrfToken = getCookie('XSRF-TOKEN')
        const res = await fetch(`/api/users/${user.value?.CodU}`, {
            method: 'PUT',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-XSRF-TOKEN': xsrfToken
            },
            body: JSON.stringify({
                Name: params.name,
                UserName: params.userName,
                Email: params.email,
                Password: params.password,
            })
        })
        const json = await res.json()
        if (!res.ok) {
            throw new Error(json.message || `Error del servidor (${res.status})`)
        }
        // Actualiza el store con los nuevos datos
        if (json.success) {
            user.value = json.data
        }
        return json
    }

    return {
        user,
        ready,
        isAuthenticated,
        isAdmin,
        fetchUser,
        login,
        logout,
        updateUser,
    }
})