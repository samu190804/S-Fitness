
export async function RegisterUser(params: any) {
    const formData = new FormData();

    formData.append('Name', params.name);
    formData.append('UserName', params.userName);
    formData.append('Email', params.email);
    formData.append('Password', params.password);
    // formData.append('userPhoto', params.userData.userPhoto);
    const response = await fetch('http://localhost:8080/api/signin', {
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