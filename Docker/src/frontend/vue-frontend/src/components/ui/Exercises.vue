<script setup lang="ts">
import { getEmbedUrl } from '@/services/exercises';
interface Props {
    exercises: Exercise[];
}

const props = defineProps<Props>()

</script>

<template>

    <div class="col-12 col-md-6 col-lg-4" v-for="exer in exercises" :key="exer.CodE">
        <div class="card h-100">
            <div class="ratio ratio-16x9">
                <iframe :src="getEmbedUrl(exer.Video)" title="YouTube video" allowfullscreen></iframe>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ exer.Name }}</h5>
                <h6 class="card-title">Creador: {{ exer.UserName }}
                    <!-- <img :src="'Php/' + exer.Img" class="rounded-circle imgPerfil" /> -->
                </h6>
                <p class="card-text">{{ exer.Descripcion }}</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Número de Series: {{ exer.Series }}</li>
                <li class="list-group-item">Número de Repeticiones: {{ exer.Repeticiones }}</li>
                <li class="list-group-item">Músculo: {{ exer.Musculo }}</li>
                <!-- <button v-if="userData.userAdmin == '1'" v-on:click="borrarEjer(exer.CodE)"
                        class="btn btn-danger indexbtn" role="button">Borrar</button> -->
            </ul>
        </div>
    </div>

</template>