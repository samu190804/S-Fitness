<script>
import logo from "../../assets/LogoS.png"
</script>

<template>
    <footer class="col-12 bg-body-tertiary footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-4">
                    <a class="navbar-brand mx-auto" href="#">
                        <img :src=logo height="150" class="rounded mx-auto d-block">
                    </a>
                </div>
                <div class="col-12 col-lg-4">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-auto">
                            <h6 class="mx-auto">Encuentranos</h6>
                        </li>
                        <li class="nav-item mx-auto">
                            <a href="https://es-es.facebook.com/" class="mx-auto"><i class="fab fa-facebook"></i></a>
                            <a href="https://twitter.com/home?lang=es" class="mx-auto"><i
                                    class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/" class="mx-auto"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com" class="mx-auto"><i class="fab fa-youtube"></i></a>
                            <a href="https://es.linkedin.com" class="mx-auto"><i class="fab fa-linkedin"></i></a>
                        </li>
                        <li class="nav-item mx-auto">
                            <p>Correo: samu190804@gmail.com</p>
                        </li>
                        <li class="nav-item mx-auto">
                            <p>Telefono: 789 324 534</p>
                        </li>
                        <li class="nav-item mx-auto">
                            <p>Dirección: Alicante C/Luis Zornoza nº 46</p>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-lg-4">
                    <div>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item mx-auto">
                                <a href="Pdf/Aviso_Legal_SFit.pdf" class="nav-link">Aviso Legal</a>
                            </li>
                            <li class="nav-item mx-auto">
                                <a href="Pdf/Politica_Privacidad_SFit.pdf" class="nav-link">Política de
                                    Privacidad</a>
                            </li>
                            <li class="nav-item mx-auto">
                                <a href="Pdf/Politica_Cookies_SFit.pdf" class="nav-link">Política de
                                    Cookies</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>

<style scoped>
.footer {
    margin-top: 2rem;
}

.footer a:hover {
    color: rgb(56, 187, 100);
}

.fab {
    color: black;
}

.fab:hover {
    color: rgb(56, 187, 100);
}
</style>