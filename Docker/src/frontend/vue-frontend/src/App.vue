<script setup lang="ts">
import { RouterView } from 'vue-router'
import Navbar from './components/common/Navbar.vue';
import Footer from './components/common/Footer.vue';
import { useAuthStore } from '@/stores/auth'
import { onMounted } from 'vue';
import router from './router';

const auth = useAuthStore()

onMounted(async () => {
  try {
    await auth.fetchUser()
  } catch (e: any) {
    router.push('/')
  }
})
</script>

<template>
  <header>
    <Navbar />
  </header>
  <RouterView />
  <footer>
    <Footer />
  </footer>
</template>

<style></style>
