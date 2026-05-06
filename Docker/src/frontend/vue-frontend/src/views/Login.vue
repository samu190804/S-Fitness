<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import { reactive} from 'vue'
import { login } from '@/services/login'

const section = 'Inicio de Sesión'
const info = '¡Inicia sesión para empezar a compartir!'

let params = reactive(
    {
        email: '',
        password: ''
    })
    
const log = async () => {
    try {
        const data = await login(params)
        console.log(data)
    } catch (error) {
        console.error('Error al iniciar sesión:', error)
    }
}
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="row d-flex justify-content-center login">
            <div class="col-12 col-xl-4">
                <!-- <h4 class="text-center">{{ resultado }}</h4> -->
                <form @submit.prevent="log" class="row g-3 mx-auto" style="max-width: 500px;">
                    <div class="form-floating col-12">
                        <input type="email" max=100 class="form-control" id="floatingInput" placeholder="name@example.com"
                            v-model="params.email">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating col-12">
                        <input type="password" min=8 class="form-control" id="floatingPassword" placeholder="Password"
                            v-model="params.password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success me-2">Iniciar sesión</button>
                        <span class="align-self-center me-2">¿No tienes cuenta?</span>
                        <RouterLink to="/signup" class="btn btn-outline-success">Registrarse</RouterLink>
                    </div>
                </form>
            </div>
        </div>
    </main>
</template>

<style scoped>
.login{
    margin-bottom: 1.5rem;
}
</style>