<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import { reactive, ref } from 'vue'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()

const section = 'Registro de Usuario'
const info = '¡Regístrate y comparte conocimiento!'
const error = ref('')

const params = reactive({
    Name: "",
    Dias: 0,
    Duracion: 0,
    Nivel: 0,
    Musculos: "",
    Descripcion: "",
    CodU: auth.user?.CodU,
    ejercicios: []
})

const create = async () => {
    error.value = ''
    try {
        // const result = await createExer(params) 

        // if (result.success) {
        // }
    } catch (e: any) {
        error.value = e.message || 'Error al crear la rutina'
    }
}
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="col-12 text-center">
            <form @submit.prevent="create" class="row g-3 mx-auto" style="max-width: 500px;">
                <div class="form-floating col-12">
                    <input type="text" class="form-control" id="floatingName" v-model="params.Name">
                    <label for="floatingName">Nombre</label>
                </div>
                <div class="form-floating col-12">
                    <input type="number" min="1" max="7" class="form-control" id="floatingDias"
                        v-model="params.Dias">
                    <label for="floatingDias">Días</label>
                </div>
                <div class="form-floating col-12">
                    <input type="number" min="1" class="form-control" id="floatingDuracion"
                        v-model="params.Duracion">
                    <label for="floatingDuracion">Duración (Min)</label>
                </div>
                <div class="form-floating col-12">
                    <input type="number" min="1" max="5" class="form-control" id="floatingNivel"
                        v-model="params.Nivel">
                    <label for="floatingNivel">Nivel</label>
                </div>
                <div class="form-floating col-12">
                    <input type="text" class="form-control" id="floatingMusculo" v-model="params.Musculos">
                    <label for="floatingMusculo">Músculos</label>
                </div>
                <div class="col-12 col-sm-auto d-flex align-items-center">
                    <select class="form-select" v-model="ejercicio" multiple>
                        <option v-for="ejer in ejercicios" :key="ejer.CodE" :value="ejer">{{ ejer.Name }},
                            Creador: {{ ejer.UserName }},
                            Musc: {{ ejer.Musculo }}</option>
                    </select>
                </div>
                <div class="col-12">
                    <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Descripción" rows="3"
                        v-model="params.Descripcion"></textarea>
                </div>
                <p v-if="error" class="text-danger text-center">{{ error }}</p>
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Crear</button>
                </div>
            </form>
        </div>
    </main>
</template>

<style scoped>
.btn {
    color: white;
    margin: 0.7rem;
    font-size: 1.2rem;
}
</style>