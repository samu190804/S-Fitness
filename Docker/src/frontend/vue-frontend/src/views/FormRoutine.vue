<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import { computed, onMounted, reactive, ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { fetchExercises } from '@/services/exercises'
import { createRoutine } from '@/services/routines'

const auth = useAuthStore()

const section = 'Creador de ejercicios'
const info = '¡Comparte tu conocimiento!'
const error = ref('')
const success = ref('')
const exer = ref<Exercise[]>([])
const search = ref('')
const selectedExercises = ref<Exercise[]>([])

onMounted(async () => {
    try {
        let json = await fetchExercises();
        exer.value = json.data
    } catch (error) {
        console.error(error);
    }
})

const filteredExer = computed(() =>
    exer.value.filter(e =>
        e.Name.toLowerCase().includes(search.value.toLowerCase()) ||
        e.Musculo.toLowerCase().includes(search.value.toLowerCase())
    )
)

function toggleExercise(ex: Exercise) {
    const idx = selectedExercises.value.findIndex(s => s.CodE === ex.CodE)
    if (idx === -1) selectedExercises.value.push(ex)
    else selectedExercises.value.splice(idx, 1)
}

function isSelected(ex: Exercise) {
    return selectedExercises.value.some(s => s.CodE === ex.CodE)
}

const params = reactive({
    Name: "",
    Dias: 0,
    Duracion: 0,
    Nivel: 0,
    Musculos: "",
    Descripcion: "",
    CodU: auth.user?.CodU,
    ejercicios: [] as number[]
})

const create = async () => {
    error.value = ''
    params.ejercicios = selectedExercises.value.map(e => e.CodE)
    try {
        const result = await createRoutine(params)
        if (result.success) {
            success.value = 'Rutina Creada'
            console.log("Creado")
        }
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
                    <input type="number" min="1" max="7" class="form-control" id="floatingDias" v-model="params.Dias">
                    <label for="floatingDias">Días</label>
                </div>
                <div class="form-floating col-12">
                    <input type="number" min="1" class="form-control" id="floatingDuracion" v-model="params.Duracion">
                    <label for="floatingDuracion">Duración (Min)</label>
                </div>
                <div class="form-floating col-12">
                    <input type="number" min="1" max="5" class="form-control" id="floatingNivel" v-model="params.Nivel">
                    <label for="floatingNivel">Nivel</label>
                </div>
                <div class="form-floating col-12">
                    <input type="text" class="form-control" id="floatingMusculo" v-model="params.Musculos">
                    <label for="floatingMusculo">Músculos</label>
                </div>
                <div class="col-12 d-flex flex-wrap gap-2 py-1">
                    <span v-if="!selectedExercises.length" class="text-muted small">
                        Ningún ejercicio seleccionado
                    </span>
                    <span v-for="ex in selectedExercises" :key="ex.CodE"
                        class="badge rounded-pill d-flex align-items-center gap-1 text-bg-success">
                        {{ ex.Name }}
                        <button type="button" class="btn-close btn-close-white btn-close-sm ms-1"
                            @click="toggleExercise(ex)">
                        </button>
                    </span>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control" placeholder="Buscar ejercicio por nombre o músculo..."
                        v-model="search">
                </div>
                <div class="col-12 border rounded exercise-list">
                    <div v-for="ex in filteredExer" :key="ex.CodE"
                        class="d-flex align-items-center gap-2 p-2 exercise-item"
                        :class="{ 'bg-success-subtle': isSelected(ex) }" @click="toggleExercise(ex)">
                        <input type="checkbox" class="form-check-input mt-0" :checked="isSelected(ex)"
                            @click.stop="toggleExercise(ex)">
                        <div class="text-start">
                            <div class="fw-medium small">{{ ex.Name }}</div>
                            <div class="text-muted" style="font-size: 12px">
                                {{ ex.Musculo }} · {{ ex.usuario.UserName }}
                            </div>
                        </div>
                    </div>
                    <div v-if="!filteredExer.length" class="text-center text-muted p-3 small">
                        Sin resultados
                    </div>
                </div>
                <div class="col-12">
                    <textarea class="form-control" placeholder="Descripción" rows="3"
                        v-model="params.Descripcion"></textarea>
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

.exercise-list {
    max-height: 220px;
    overflow-y: auto;
}

.exercise-item {
    cursor: pointer;
    border-bottom: 1px solid var(--bs-border-color);
    transition: background-color 0.15s ease;
}

.exercise-item:last-child {
    border-bottom: none;
}

.exercise-item:hover {
    background-color: var(--bs-success-bg-subtle);
}
</style>