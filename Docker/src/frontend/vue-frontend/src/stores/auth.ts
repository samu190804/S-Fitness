import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { initCsrf, getCookie } from '@/services/login'

// Tipo para tu usuario
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

export const useAuthStore = defineStore('auth', () => {

    // ── Estado ──────────────────────────────────────────
    const user = ref<User | null>(null)
    const ready = ref(false) // ¿Ya verificamos si hay sesión activa?

    // ── Getters ─────────────────────────────────────────
    const isAuthenticated = computed(() => !!user.value)
    const isAdmin = computed(() => user.value?.admin ?? false)

    // ── Actions ─────────────────────────────────────────

    // Llamado al cargar la app — recupera sesión si existe
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

        // Paso 1 - Pedir CSRF cookie
        await initCsrf()

        // Paso 2 - Leer el XSRF-TOKEN de las cookies
        const xsrfToken = getCookie('XSRF-TOKEN')

        // Paso 3 - Login enviando el token en el header
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

    return {
        user,
        ready,
        isAuthenticated,
        isAdmin,
        fetchUser,
        login,
        logout,
    }
})