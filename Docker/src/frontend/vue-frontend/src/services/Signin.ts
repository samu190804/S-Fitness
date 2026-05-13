
export async function RegisterUser(params: any) {
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
        },
        body: JSON.stringify(data)
    })

    const json = await response.json()

    if (!response.ok) {
        throw new Error(json.message || `Error del servidor (${response.status})`)
    }

    return json
}