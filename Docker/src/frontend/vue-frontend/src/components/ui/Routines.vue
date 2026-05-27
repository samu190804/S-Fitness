<script setup lang="ts">
import { deleteRoutine } from '@/services/routines';
import { useAuthStore } from '@/stores/auth';


interface Props {
    routines: Routine[];
}

const props = defineProps<Props>()
const auth = useAuthStore()

const emit = defineEmits<{
    'deleted': [id: number]
}>()

const delRoutine = async (id: number) => {
    let check = confirm("¿Seguro que quiere borrar la rutina")
    if (check) {
        try {
            const result = await deleteRoutine(id)
            if (result.success) {
                emit('deleted', id)
            }
        } catch (e) {
            console.error('Error al conectar con el servidor')
        }
    }
}
</script>

<template>
    <div class="col-12 col-md-6 col-lg-4" v-for="routine in routines">
        <div class="card h-100">
            <div class="card-body">
                <h3 class="card-title">{{ routine.Name }}</h3>
                <h6 class="card-title text-muted">
                    Creador: {{ routine.usuario.UserName }}
                    <img :src="routine.usuario.Img
                                ? `/storage/${routine.usuario.Img}`
                                : '/defaultPicture.png'" class="rounded-circle imgPerfil" />
                </h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Días: {{ routine.Dias }}</li>
                <li class="list-group-item">Duración: {{ routine.Duracion }} min.</li>
                <li class="list-group-item py-3">
                    <div class="d-flex align-items-center">
                        <span class="me-3 fw-medium small">Dificultad</span>
                        <div class="progress flex-grow-1" style="height: 8px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                :style="{ width: (routine.Nivel * 20) + '%' }" :class="{
                                    'bg-info': routine.Nivel == 1,
                                    'bg-success': routine.Nivel == 2,
                                    'bg-warning': routine.Nivel == 3,
                                    'bg-danger': routine.Nivel >= 4
                                }">
                            </div>
                        </div>
                        <span class="ms-3 text-muted small">{{ routine.Nivel }}/5</span>
                    </div>
                </li>
                <li v-if="auth.user?.CodU == routine.CodU || auth.user?.admin" class="list-group-item p-0">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Opciones
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <button @click="delRoutine(routine.CodR)" class="btn text-danger w-100 py-2 small">
                                    <i class="bi bi-trash me-1"></i> Eliminar rutina
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>
.imgPerfil {
    width: 40px;
    height: 40px;
    object-fit: cover;
}
</style>