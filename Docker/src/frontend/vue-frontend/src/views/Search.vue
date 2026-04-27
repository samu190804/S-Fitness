<script setup lang="ts">
import Section from '@/components/common/Section.vue';
import Exercises from '@/components/ui/Exercises.vue';
// import Routines from '@/components/ui/Routines.vue';
import FilterQuery from '@/components/ui/FilterQuery.vue';
import { onMounted, ref } from 'vue'
import { fetchExercises } from '@/services/exercises';

const section = 'En esta sección podrás ver todos los ejercicios y rutinas.'
const info = '¡Echa un vistazo!'
let resultado = ref('')
let descripcion = ref('')
const query = ref<Exercise[]>([])

onMounted(async () => {
    try {
        let json = await fetchExercises();
        query.value = json.data
    } catch (error) {
        resultado.value = "Sin resultado";
        console.error(error);
    }
})

const handleFilterApplied = (data: any) => {
    query.value = data.data
    resultado.value = 'Filtros aplicados'
    descripcion.value = ''
};
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5 mb-5 mx-2 mx-md-5">
        <div class="row">
            <FilterQuery @filter-applied="handleFilterApplied"/>
            <h4>{{ resultado }}</h4>
            <p class="descripcionR">{{ descripcion }}</p>

            <div class="row">
                <Exercises :exercises="query" />
                <!-- <Routines/> -->
            </div>
        </div>
    </main>
</template>
