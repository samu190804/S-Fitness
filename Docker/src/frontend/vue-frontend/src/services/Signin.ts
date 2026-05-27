import { getCookie, initCsrf } from "./cookiesCSRF"

export async function registerUser(params: any) {
    await initCsrf()
    const xsrfToken = getCookie('XSRF-TOKEN')

    let data = JSON.stringify({
        Name: params.name,
        UserName: params.userName,
        Email: params.email,
        Password: params.password,
    })
    const response = await fetch('/api/signin', {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-XSRF-TOKEN': xsrfToken
        },
        body: data
    })
    const json = await response.json()

    if (!response.ok) {
        throw new Error(json.message || `Error del servidor (${response.status})`)
    }

    return json
}

export async function deleteUser(id: any) {
    const xsrfToken = getCookie('XSRF-TOKEN')

    const response = await fetch(`/api/users/${id}`, {
        method: 'DELETE',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-XSRF-TOKEN': xsrfToken
        }
    })
    const json = await response.json()

    if (!response.ok) {
        throw new Error(json.message || `Error del servidor (${response.status})`)
    }

    return json
}

export async function uploadPhoto(photo: File): Promise<string | null> {
    await initCsrf()
    const xsrfToken = getCookie('XSRF-TOKEN')
    const formData = new FormData()
    formData.append('userPhoto', photo)
    const response = await fetch('/api/users/foto', {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Accept': 'application/json',
            'X-XSRF-TOKEN': xsrfToken
        },
        body: formData
    })
    const json = await response.json()
    if (!response.ok || !json.uploadOk) return null
    return json.path  // devuelve la ruta para guardarla en el usuario
}

export async function updateUser(params: any) {
    const xsrfToken = getCookie('XSRF-TOKEN')

    const body: any = {
        Name: params.name,
        UserName: params.userName,
        Email: params.email,
    }

    if (params.password) body.Password = params.password
    if (params.Img) body.Img = params.Img

    const response = await fetch(`/api/users/${params.codU}`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-XSRF-TOKEN': xsrfToken
        },
        body: JSON.stringify(body)
    })
    const json = await response.json()
    if (!response.ok) {
        throw new Error(json.message || `Error del servidor (${response.status})`)
    }
    return json
}