<script lang="ts">
</script>

<template>
    <div class="container-fluid">

        <form @submit.prevent="mostrarConFiltros(false)" class="row filtro">

            <div class="col-12 col-sm-auto ">
                <button type="submit" class="btn btn-success">Aplicar filtros</button>
            </div>

            <div class="col-12 col-sm-auto ">
                <select class="form-select" @change="cambioTipo()" v-model="tipo">
                    <option selected>Ejercicios</option>
                    <option>Rutinas</option>
                </select>
            </div>

            <div class="col-12 col-sm-auto ">
                <input type="text" class="form-control" id="inputNombre" placeholder="Nombre"
                    v-model="parametrosQuery.Qnombre">
            </div>

            <div class="col-12 col-sm-auto " v-if="tipo == 'Ejercicios'">
                <input type="text" class="form-control" id="inputNombre" placeholder="Músculo"
                    v-model="parametrosQuery.Qmusculo">
            </div>

            <div class="col-12 col-sm-auto " v-else-if="tipo == 'Rutinas'">
                <input type="text" class="form-control" id="inputNombre" placeholder="Músculos"
                    v-model="parametrosQuery.Qmusculos">
            </div>

            <div class="col-12 col-sm-auto " v-if="tipo == 'Ejercicios'">
                <input type="number" min="1" class="form-control" placeholder="Series"
                    v-model="parametrosQuery.Qnseries">
            </div>

            <div class="col-12 col-sm-auto " v-else-if="tipo == 'Rutinas'">
                <input type="number" min="1" max="7" class="form-control" placeholder="Días"
                    v-model="parametrosQuery.Qdias">
            </div>

            <div class="col-12 col-sm-auto " v-if="tipo == 'Ejercicios'">
                <input type="number" min="1" class="form-control" placeholder="Reps"
                    v-model="parametrosQuery.Qnrepeticiones">
            </div>

            <div class="col-12 col-sm-2 " v-else-if="tipo == 'Rutinas'">
                <input type="number" min="1" class="form-control" placeholder="Duración"
                    v-model="parametrosQuery.Qduracion">
            </div>

            <div class="col-12 col-sm-2 " v-if="tipo == 'Rutinas'">
                <input type="number" max="5" min="1" class="form-control" placeholder="Dificultad"
                    v-model="parametrosQuery.Qnivel">
            </div>

        </form>

    </div>
</template>