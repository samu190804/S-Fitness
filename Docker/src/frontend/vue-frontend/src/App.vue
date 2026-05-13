<script setup lang="ts">
import {RouterView } from 'vue-router'
import Navbar from './components/common/Navbar.vue';
import Footer from './components/common/Footer.vue';
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
await auth.fetchUser() // Pregunta al backend si hay sesión activa
</script>

<template>
  <header>
    <Navbar/>
  </header>
  <RouterView/>
  <footer>
    <Footer/>
  </footer>
</template>

<style>

</style>
