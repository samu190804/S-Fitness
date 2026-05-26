<script setup lang="ts">
import Section from '@/components/common/Section.vue';
import { useAuthStore } from '@/stores/auth'
import { RouterLink } from 'vue-router'

const section = 'En esta sección podrás crear tus propios ejercicios y rutinas.'
const info = '¡Crea y disfruta!'
const auth = useAuthStore()
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="col-12 text-center mb-5" v-if="auth.isAuthenticated">
            <h3>Elige qué quieres crear</h3>
            <RouterLink to="/formExer" class="btn btn-outline-success mx-2">Crear
                Ejercicio</RouterLink>
            <RouterLink to="/formRoutine" class="btn btn-outline-success mx-2">Crear
                Rutina</RouterLink>
        </div>
        <div class="col-12 text-center" v-else>
            <h1>¡Bienvenido!</h1>
            <p class="lead">Debes iniciar sesión para crear ejercicios o rutinas.</p>
            <RouterLink to="/login" class="btn btn-success login">Iniciar
                sesión</RouterLink>
        </div>

    </main>
</template>

<style scoped>
</style>