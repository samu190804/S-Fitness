<script setup lang="ts">
import Section from '@/components/common/Section.vue'
import { reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { uploadPhoto } from '@/services/Signin'

const router = useRouter()
const auth = useAuthStore()

const section = 'Actualizar Usuario'
const info = ''
const error = ref('')

const photo = ref<File | null>(null)

const onPhotoChange = (e: Event) => {
    const input = e.target as HTMLInputElement
    photo.value = input.files?.[0] ?? null
}

const params = reactive({
    name: auth.user?.Name ?? '',
    userName: auth.user?.UserName ?? '',
    email: auth.user?.Email ?? '',
    password: '',
    Img: ''
})

const update = async () => {
    error.value = ''
    try {
        if (photo.value) {
            const path = await uploadPhoto(photo.value)
            if (path) {
                params.Img = path
            }
        }
        const result = await auth.updateUser(params)
        if (result.success) {
            router.push('/')
        }
    } catch (e: any) {
        error.value = e.message || 'Error al actualizar el usuario'
    }
}
</script>

<template>
    <Section :info :section />
    <main class="row bloquecentral mb-5">
        <div class="row d-flex justify-content-center sign">
            <div class="col-12 col-xl-4">
                <!-- <h4 class="text-center">{{ resultado }}</h4> -->
                <form @submit.prevent="update" class="row g-3 mx-auto" style="max-width: 500px;">
                    <div class="form-floating col-12">
                        <input type="text" max=50 class="form-control" id="floatingName" placeholder="Nombre completo"
                            v-model="params.name">
                        <label for="floatingName">Nombre completo</label>
                    </div>
                    <div class="form-floating col-12">
                        <input type="text" max=50 class="form-control" id="floatingUsername"
                            placeholder="Nombre de usuario" v-model="params.userName">
                        <label for="floatingUsername">Nombre de usuario</label>
                    </div>
                    <div class="form-floating col-12">
                        <input type="email" max=100 class="form-control" id="floatingEmail"
                            placeholder="name@example.com" v-model="params.email">
                        <label for="floatingEmail">Email</label>
                    </div>
                    <div class="form-floating col-12">
                        <input type="password" min=8 class="form-control" id="floatingPassword"
                            placeholder="Contraseña" v-model="params.password">
                        <label for="floatingPassword">Nueva contraseña (opcional)</label>
                    </div>
                    <div class="col-12">
                        <label for="profileImage" class="form-label">Imagen de perfil</label>
                        <input class="form-control" type="file" accept="image/*" id="profileImage"
                            @change="onPhotoChange">
                    </div>
                    <p v-if="error" class="text-danger text-center">{{ error }}</p>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</template>
