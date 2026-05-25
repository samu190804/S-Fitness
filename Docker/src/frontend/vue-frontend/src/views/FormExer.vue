<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import { reactive, ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { createExer } from '@/services/exercises'
const auth = useAuthStore()

const section = 'Creador de ejercicios'
const info = '¡Comparte tu conocimiento!'
const error = ref('')
const success = ref('')

const params = reactive({
  Name: "",
  Musculo: "",
  Series: 0,
  Repeticiones: 0,
  Descripcion: "",
  Video: "",
  CodU: auth.user?.CodU
})

const create = async () => {
    error.value = ''
    try {
        const result = await createExer(params) 
        console.log(result)
        if (result.success) {
            success.value = 'Ejercicio Creado'
            console.log("Creado")
        }
    } catch (e: any) {
        error.value = e.message || 'Error al crear el ejercicio'
    }
}
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="col-12 text-center">
            <form @submit.prevent="create" class="row g-3 mx-auto" style="max-width: 500px;">
                <div class="form-floating col-12">
                    <input required type="text" max="50" class="form-control" id="floatingName" v-model="params.Name">
                    <label for="floatingName">Nombre</label>
                </div>
                <div class="form-floating col-12">
                    <input required type="text" max="50" class="form-control" id="floatingMusculo" v-model="params.Musculo">
                    <label for="floatingMusculo">Músculo/s</label>
                </div>
                <div class="form-floating col-12">
                    <input required type="number" min="1" class="form-control" id="floatingSeries"
                        v-model="params.Series">
                    <label for="floatingEmail">Series</label>
                </div>
                <div class="form-floating col-12">
                    <input required type="number" min="1" class="form-control" id="floatingReps"
                        v-model="params.Repeticiones">
                    <label for="floatingReps">Reps</label>
                </div>
                <div class="col-12">
                    <textarea required class="form-control" id="exampleFormControlTextarea1" placeholder="Descripción" rows="3"
                        v-model="params.Descripcion"></textarea>
                </div>
                <div class="form-floating col-12">
                    <input required type="text" class="form-control" id="floatingVideo" v-model="params.Video">
                    <label for="floatingVideo">Link Video</label>
                </div>
                <p v-if="success" class="text-success text-center">{{ success }}</p>
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