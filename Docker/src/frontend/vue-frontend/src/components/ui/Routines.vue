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
                                <h6 class="card-title">Creador: {{ routine.usuario.UserName }} <img :src="'Php/' + routine.Img"
                                                class="rounded-circle imgPerfil" /></h6>
                        </div>
                        <ul class="list-group list-group-flush">
                                <li class="list-group-item">Días: {{ routine.Dias }}</li>
                                <li class="list-group-item">Duración: {{ routine.Duracion }} min.</li>
                                <li class="list-group-item py-3">
                                        <div class="d-flex align-items-center">
                                                <span class="me-3 fw-bold">Dificultad:</span>
                                                <div class="progress flex-grow-1"
                                                        style="height: 12px; background-color: #e9ecef;">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                role="progressbar"
                                                                :style="{ width: (routine.Nivel * 20) + '%' }" :class="{
                                                                        'bg-info': routine.Nivel == 1,
                                                                        'bg-success': routine.Nivel == 2,
                                                                        'bg-warning': routine.Nivel == 3,
                                                                        'bg-danger': routine.Nivel >= 4
                                                                }"></div>
                                                </div>
                                                <span class="ms-3 badge rounded-pill bg-dark">{{ routine.Nivel }} /
                                                        5</span>
                                        </div>
                                </li>
                                <!-- <button v-on:click="mostrarEjerciciosroutine(routine.CodR, routine.Name, routine.UserName, routine.Descripcion)"
                class="btn btn-success indexbtn" role="button">Ver Ejercicios</button> -->
                                <!-- <button v-if="userData.userAdmin == '1'" v-on:click="borrarroutine(routine.CodR)"
                class="btn btn-danger indexbtn" role="button">Borrar</button> -->
                        </ul>
                </div>
        </div>
</template>