export async function login(params: any) {
    let json = JSON.stringify({
            email: params.email,
            password: params.password,
        })
    console.log(json)
    const response = await fetch('/api/login', {
        method: 'POST',
                headers: {
            'Content-Type': 'application/json',
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
    const response = await fetch('/api/logout/login', {
        method: 'POST'
    })
    if (!response.ok) {
        throw new Error('Error en la respuesta del servidor')
    }else{
        console.log(response.json())
        return await response.json()
    }
}