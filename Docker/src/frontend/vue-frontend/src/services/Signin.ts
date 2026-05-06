
export async function RegisterUser(params: any) {
    let json = JSON.stringify({
        Name: params.name,
        UserName: params.userName,
        Email: params.email,
        Password: params.password,
    })
    const response = await fetch('/api/signin', {
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