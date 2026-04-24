<script setup lang="ts">
import {RouterView } from 'vue-router'
import Navbar from './components/common/Navbar.vue';
import Footer from './components/common/Footer.vue';
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
