<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import { registerUser } from '@/services/Signin'
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const auth = useAuthStore()

const section = 'Registro de Usuario'
const info = '¡Regístrate y comparte conocimiento!'
const error = ref('')
const success = ref('')

const params = reactive({
    name: '',
    userName: '',
    email: '',
    password: ''
})

const register = async () => {
    error.value = ''
    try {
        const create = await registerUser(params)
        
        if (create.success){
            success.value = "Usuario creado"
        }
        
        const result = await auth.login({
            email: params.email,
            password: params.password
        })

        if (result.success) {
            router.push('/')
        }
    } catch (e: any) {
        error.value = e.message || 'Error al registrar el usuario'
    }
}
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="row d-flex justify-content-center sign">
            <div class="col-12 col-xl-4">
                <!-- <h4 class="text-center">{{ resultado }}</h4> -->
                <form @submit.prevent="register" class="row g-3 mx-auto" style="max-width: 500px;">
                    <div class="form-floating col-12">
                        <input required type="text" max=50 class="form-control" id="floatingName"
                            placeholder="Nombre completo" v-model="params.name">
                        <label for="floatingName">Nombre completo</label>
                    </div>
                    <div class="form-floating col-12">
                        <input required type="text" max=50 class="form-control" id="floatingUsername"
                            placeholder="Nombre de usuario" v-model="params.userName">
                        <label for="floatingUsername">Nombre de usuario</label>
                    </div>
                    <div class="form-floating col-12">
                        <input required type="email" max=100 class="form-control" id="floatingEmail"
                            placeholder="name@example.com" v-model="params.email">
                        <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating col-12">
                        <input required type="password" min=8 class="form-control" id="floatingPassword"
                            placeholder="Contraseña" v-model="params.password">
                        <label for="floatingPassword">Contraseña</label>
                    </div>
                    <!-- <div class="col-12">
                        <label for="profileImage" class="form-label">Imagen de perfil</label>
                        <input class="form-control" type="file" name="foto" id="profileImage" @change="">
                    </div> -->
                    <p v-if="success" class="text-success text-center">{{ success }}</p>
                    <p v-if="error" class="text-danger text-center">{{ error }}</p>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</template>
