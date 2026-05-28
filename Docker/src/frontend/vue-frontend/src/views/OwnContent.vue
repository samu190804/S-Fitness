<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import Exercises from '@/components/ui/Exercises.vue'
import Routines from '@/components/ui/Routines.vue'
import FilterQuery from '@/components/ui/FilterQuery.vue'
import { onMounted, reactive, ref } from 'vue'
import { fetchFilter } from '@/services/exercises'
import { useAuthStore } from '@/stores/auth'
import { exercisesfrRoutine } from '@/services/routines'

const auth = useAuthStore()
const section = 'Tus ejercicios y rutinas.'
const info = '¡Echa un vistazo!'
let resultado = ref('')
let descripcion = ref('')
const query = ref<any[]>([])
let type = ref(0)
let params = reactive({ QCodU: auth.user?.CodU })

onMounted(async () => {
    try {
        let json = await fetchFilter(params, type.value)
        query.value = json.data
    } catch (error) {
        resultado.value = "Sin resultado";
        console.error(error);
    }
})

const handleFilterApplied = (data: any, typeF: number) => {
    if (typeF !== type.value) {
        query.value = []
    }
    query.value = data.data
    resultado.value = 'Filtros aplicados'
    descripcion.value = ''
    type.value = typeF
}

const showExerfrRoutine = async (id: number, rName: string, userName: string) => {
    try {
        let json = await exercisesfrRoutine(id)
        query.value = json.data
        type.value = 0
        resultado.value = `Viendo ejercicios de ${rName}, de: ${userName}`;
    } catch (error) {
        resultado.value = `Sin Resultados`;
        console.error(error);
    }
}
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5 mb-5 mx-2 mx-md-5">
        <div class="row">
            <FilterQuery :-q-cod-u="auth.user?.CodU" @filter-applied="handleFilterApplied" />
            <h4>{{ resultado }}</h4>
            <p class="descripcionR">{{ descripcion }}</p>

            <div class="row">
                <Exercises :exercises="query" @deleted="(id) => query = query.filter(e => e.CodE !== id)"
                    v-if="!type" />
                <Routines :routines="query" @showExer="showExerfrRoutine"
                    @deleted="(id) => query = query.filter(r => r.CodR !== id)" v-else />
            </div>
        </div>
    </main>
</template>
