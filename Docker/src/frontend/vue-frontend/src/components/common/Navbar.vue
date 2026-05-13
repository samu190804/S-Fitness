<script setup lang="ts">
import { RouterLink } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const auth = useAuthStore()
</script>

<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container">
            <RouterLink to="/" class="navbar-brand"><img src='/LogoS.png' height="150"></RouterLink>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto" id="navegador">
                    <RouterLink to="/" class="nav-link nav-link:hover">Inicio</RouterLink>
                    <RouterLink to="/search" class="nav-link nav-link:hover">Buscar Ejercicio/Rutina</RouterLink>
                    <RouterLink to="/create" class="nav-link nav-link:hover">Empezar a compartir</RouterLink>
                    <li class="nav-item dropdown" v-if="auth.isAuthenticated">
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
                    <li class="nav-item" v-else>
                        <RouterLink to="/login" class="btn btn-success login">Iniciar
                            sesión</RouterLink>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.nav-link {
    color: rgb(56, 187, 100);
    font-size: 1.5rem;
    text-decoration: none;
    display: flex;
    align-items: center;
}

/* Estilo al pasar el mouse */
.nav-link:hover {
    color: rgb(40, 150, 70);
}

.btn {
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