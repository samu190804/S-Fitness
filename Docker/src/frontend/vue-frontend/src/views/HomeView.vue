<script setup lang="ts">
import Section from '@/components/common/Section.vue'
let section = 'Bienvenido a S+ Fitness la casa de todo deportista.'
let info = '¡Aqui podras encontrar todo tipo de ejercicios y rutinas!'
</script>

<template>
  <Section :info :section />
  <main class="row bloquecentral mb-5">
    <div class="row index">
      <h4></h4>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-6">
            <img src="/pesomuerto.png" class="img-fluid rounded mx-auto" alt="...">
          </div>
          <div class="col-12 col-lg-6 d-flex flex-column">
            <h3>¿Qué es S+Fitness?</h3>
            <p><b>S+Fitness</b> es una plataforma en la que compartir ejercicios y rutinas para toda la
              comunidad deportiva. No es necesario que compartas nada aqui para ver el contenido, todo
              es de todos.
              La idea de esta página es que cada individuo que quiera empezar en el gimnasio, cambiar
              de rutinas o ejercicios pueda hacerlo de forma fácil, rápida y GRATIS.
            </p>
            <p>
              Sin necesidad de registrarse podrás acceder a todo el contenido de la web y consultar
              toda la información.
              El registro en la aplicación solo sera para poder crear tus propios ejercicios o
              rutinas, subirlos a la plataforma y comentar en las rutinas de otros usuarios.
            </p>
            <p>
              Y recuerda ser respetuoso a la hora de valorar el contenido de otros usuarios, hacer
              deporte, comer sano y ser feliz.
            </p>
            <div class="d-flex justify-content-center">
              <RouterLink to="/search" class="btn btn-success indexbtn">Buscar
                ejercicios/rutinas</RouterLink>
              <RouterLink to="/create" class="btn btn-success indexbtn">Empezar a
                compartir</RouterLink>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.indexbtn{
    margin: 0.7rem;
}
</style>