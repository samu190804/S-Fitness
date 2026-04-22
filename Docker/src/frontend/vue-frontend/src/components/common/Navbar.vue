<script>
import logo from "../../assets/LogoS.png"
</script>

<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img :src=logo height="150">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto" id="navegador">
                    <li class="nav-item">
                        <button v-on:click="" class="nav-link">Inicio</button>
                    </li>
                    <li class="nav-item">
                        <button v-on:click="" class="nav-link">Buscar Ejercicio/Rutina</button>
                    </li>
                    <li class="nav-item">
                        <button v-on:click="" class="nav-link">Empezar a compartir</button>
                    </li>
                    <li class="nav-item dropdown" v-if="login">
                        <a data-mdb-dropdown-init
                            class="nav-link dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                            id="navbarDropdownMenuAvatar" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" v-on:click="" href="#">Editar
                                    Perfil</a></li>
                            <li><a class="dropdown-item" v-on:click="" href="#">Mis
                                    Ejercicios/Rutinas</a></li>
                            <li><a class="dropdown-item" v-on:click="" href="#">Cerrar
                                    Sesion</a></li>
                            <li><a class="dropdown-item" id="borrarCuenta" v-on:click="" href="#">Borrar Cuenta</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" v-else-if="!login">
                        <button v-on:click="" class="btn btn-success login">Iniciar
                            sesión</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.nav-item > button {
    color: rgb(56, 187, 100);
    font-size: 1.5rem;
}

.nav-item > .btn {
    color: white;
    margin: 0.7rem;
    font-size: 1.2rem;
}

.navbar-collapse {
    margin-right: 2rem;
}

.dropdown-item {
    color: rgb(56, 187, 100);
}

#borrarCuenta {
    color: red;
}

.imgPerfil {
    width: 40px;
    height: 40px;
    object-fit: cover;
}
</style>