export async function login(params: any) {
    const formData = new FormData();

    formData.append('Email', params.email);
    formData.append('Password', params.password);
    // formData.append('userPhoto', params.userData.userPhoto);
    const response = await fetch('/api/login', {
        method: 'POST',
        body: formData
    })
    if (!response.ok) {
        throw new Error('Error en la respuesta del servidor')
    }else{
        console.log(response.json())
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