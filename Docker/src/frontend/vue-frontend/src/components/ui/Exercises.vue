<script setup lang="ts">
import { deleteExer, getEmbedUrl } from '@/services/exercises';
import { useAuthStore } from '@/stores/auth';
interface Props {
    exercises: Exercise[];
}

const props = defineProps<Props>()
const auth = useAuthStore()

const emit = defineEmits<{
    'deleted': [id: number]
}>()

const delExer = async (id: number) => {
    let check = confirm("¿Seguro que quiere borrar el ejercicio")
    if (check) {
        try {
            const result = await deleteExer(id)
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

    <div class="col-12 col-md-6 col-lg-4" v-for="exer in exercises" :key="exer.CodE">
        <div class="card h-100">
            <div class="ratio ratio-16x9">
                <iframe :src="getEmbedUrl(exer.Video)" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ exer.Name }}</h5>
                <h6 class="card-title">Creador: {{ exer.usuario.UserName }}
                    <img :src="exer.usuario.Img
                        ? `/storage/${exer.usuario.Img}`
                        : '/defaultPicture.png'" class="rounded-circle imgPerfil" />
                </h6>
                <p class="card-text">{{ exer.Descripcion }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Número de Series: {{ exer.Series }}</li>
                <li class="list-group-item">Número de Repeticiones: {{ exer.Repeticiones }}</li>
                <li class="list-group-item">Músculo: {{ exer.Musculo }}</li>
                <li v-if="auth.user?.CodU == exer.CodU || auth.user?.admin == true" class="list-group-item p-0">
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
                                <button @click="delExer(exer.CodE)" class="btn text-danger w-100 py-2 small">
                                    <i class="bi bi-trash me-1"></i> Eliminar Ejercicio
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