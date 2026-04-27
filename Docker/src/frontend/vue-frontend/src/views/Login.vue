<script setup lang="ts">
import Section from '@/components/common/Section.vue';
const section = 'Inicio de Sesión'
const info = '¡Inicia sesión para empezar a compartir!'

let email
let password
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="row d-flex justify-content-center login">
            <div class="col-12 col-xl-4">
                <!-- <h4 class="text-center">{{ resultado }}</h4> -->
                <form @submit.prevent="" class="row g-3 mx-auto" style="max-width: 500px;">
                    <div class="form-floating col-12">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                            v-model="email">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating col-12">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                            v-model="password">
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