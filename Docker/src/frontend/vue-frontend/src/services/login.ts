export async function login(params: any) {
    let json = JSON.stringify({
        email: params.email,
        password: params.password,
    })

    // Paso 1 - Pedir CSRF cookie
    await fetch('http://localhost:8080/sanctum/csrf-cookie', {
        credentials: 'include'
    })

    // Paso 2 - Leer el XSRF-TOKEN de las cookies
    const xsrfToken = getCookie('XSRF-TOKEN')

    // Paso 3 - Login enviando el token en el header
    const response = await fetch('http://localhost:8080/api/login', {
        method: 'POST',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-XSRF-TOKEN': xsrfToken
        },
        body: json
    })
    
    if (!response.ok) {
        const text = await response.text()
        throw new Error(`Error del servidor (${response.status}): ${text}`);
    } else {
        return await response.json()
    }
}

export async function logout() {
    // formData.append('userPhoto', params.userData.userPhoto);
    const response = await fetch('/api/logout', {
        method: 'POST',
        credentials: 'include',
        headers: { 'Accept': 'application/json' }
    })
    if (!response.ok) {
        throw new Error('Error en la respuesta del servidor')
    } else {
        console.log(response.json())
        return await response.json()
    }
}

export async function me() {
    // formData.append('userPhoto', params.userData.userPhoto);
    const response = await fetch('/api/me', {
        method: 'GET',
        credentials: 'include',
        headers: { 'Accept': 'application/json' }
    })
    if (!response.ok) {
        throw new Error('Error en la respuesta del servidor')
    } else {
        console.log(response.json())
        return await response.json()
    }
}

function getCookie(name: any) {
    return decodeURIComponent(
        document.cookie
            .split('; ')
            .find(r => r.startsWith(name + '='))
            ?.split('=')[1] || ''
    )
}