<script setup lang="ts">
import { fetchFilter } from '@/services/exercises';
import { reactive, ref } from 'vue'
let type = ref(0)
let params = reactive(
    {
        Qnombre: '',
        Qmusculo: '',
        Qmusculos: '',
        Qnseries: '',
        Qdias: '',
        Qnrepeticiones: '',
        Qduracion: '',
        Qnivel: ''
    })

const emit = defineEmits<{
    'filter-applied': [data: any, type: number]
}>()

const applyFilters = async () => {
    try {
        const data = await fetchFilter(params, type.value)
        emit('filter-applied', data, type.value)  // Emite el evento con los datos
    } catch (error) {
        console.error('Error aplicando filtros:', error)
        // Opcional: emitir un error si quieres manejarlo en el padre
    }
}

</script>

<template>
    <div class="container-fluid">

        <form @submit.prevent="applyFilters" class="row filtro">

            <div class="col-12 col-sm-auto ">
                <button type="submit" class="btn btn-success">Aplicar filtros</button>
            </div>

            <div class="col-12 col-sm-auto ">
                <select class="form-select" v-model="type">
                    <option selected value=0>Ejercicios</option>
                    <option value=1>Rutinas</option>
                </select>
            </div>

            <div class="col-12 col-sm-auto ">
                <input type="text" class="form-control" id="inputNombre" placeholder="Nombre" v-model="params.Qnombre">
            </div>

            <div class="col-12 col-sm-auto " v-if="!type">
                <input type="text" class="form-control" id="inputNombre" placeholder="Músculo"
                    v-model="params.Qmusculo">
            </div>

            <div class="col-12 col-sm-auto " v-else-if="type">
                <input type="text" class="form-control" id="inputNombre" placeholder="Músculos"
                    v-model="params.Qmusculos">
            </div>

            <div class="col-12 col-sm-auto " v-if="!type">
                <input type="number" min="1" class="form-control" placeholder="Series" v-model="params.Qnseries">
            </div>

            <div class="col-12 col-sm-auto " v-else-if="type">
                <input type="number" min="1" max="7" class="form-control" placeholder="Días" v-model="params.Qdias">
            </div>

            <div class="col-12 col-sm-auto " v-if="!type">
                <input type="number" min="1" class="form-control" placeholder="Reps" v-model="params.Qnrepeticiones">
            </div>

            <div class="col-12 col-sm-2 " v-else-if="type">
                <input type="number" min="1" class="form-control" placeholder="Duración" v-model="params.Qduracion">
            </div>

            <div class="col-12 col-sm-2 " v-if="type">
                <input type="number" max="5" min="1" class="form-control" placeholder="Dificultad"
                    v-model="params.Qnivel">
            </div>

        </form>

    </div>
</template>