<script setup lang="ts">

interface Props {
        routines: Routine[];
}

const props = defineProps<Props>()
</script>

<template>
        <div class="col-12 col-md-6 col-lg-4" v-for="routine in routines">
                <div class="card h-100">
                        <div class="card-body">
                                <h3 class="card-title">{{ routine.Name }}</h3>
                                <h6 class="card-title">Creador: {{ routine.UserName }} <img :src="'Php/' + routine.Img"
                                                class="rounded-circle imgPerfil" /></h6>
                        </div>
                        <ul class="list-group list-group-flush">
                                <li class="list-group-item">Días: {{ routine.Dias }}</li>
                                <li class="list-group-item">Duración: {{ routine.Duracion }} min.</li>
                                <li v-if="routine.Nivel == '1'" class="list-group-item">Dificultad: <img
                                                class="dificultad img-fluid" src="Img/Dificultad_1.png"> </li>
                                <li v-if="routine.Nivel == '2'" class="list-group-item">Dificultad: <img
                                                class="dificultad img-fluid" src="Img/Dificultad_2.png"> </li>
                                <li v-if="routine.Nivel == '3'" class="list-group-item">Dificultad: <img
                                                class="dificultad img-fluid" src="Img/Dificultad_3.png"> </li>
                                <li v-if="routine.Nivel == '4'" class="list-group-item">Dificultad: <img
                                                class="dificultad img-fluid" src="Img/Dificultad_4.png"> </li>
                                <li v-if="routine.Nivel == '5'" class="list-group-item">Dificultad: <img
                                                class="dificultad img-fluid" src="Img/Dificultad_5.png"> </li>
                                <!-- <button v-on:click="mostrarEjerciciosroutine(routine.CodR, routine.Name, routine.UserName, routine.Descripcion)"
                class="btn btn-success indexbtn" role="button">Ver Ejercicios</button> -->
                                <!-- <button v-if="userData.userAdmin == '1'" v-on:click="borrarroutine(routine.CodR)"
                class="btn btn-danger indexbtn" role="button">Borrar</button> -->
                        </ul>
                </div>
        </div>
</template>