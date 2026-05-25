import { getCookie } from "./cookiesCSRF"

export async function registerUser(params: any) {
    const xsrfToken = getCookie('XSRF-TOKEN')

    let data = JSON.stringify({
        Name: params.name,
        UserName: params.userName,
        Email: params.email,
        Password: params.password,
    })
    const response = await fetch('/api/signin', {
        method: 'POST',
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

// export async function updateUser(params: any) {
//     const xsrfToken = getCookie('XSRF-TOKEN')

//     let data = JSON.stringify({
//         Name: params.name,
//         UserName: params.userName,
//         Email: params.email,
//         Password: params.password,
//     })
//     const response = await fetch(`/api/users/${params.codU}`, {
//         method: 'PUT',
//         headers: {
//             'Content-Type': 'application/json',
//             'Accept': 'application/json',
//             'X-XSRF-TOKEN': xsrfToken
//         },
//         body: data
//     })
//     const json = await response.json()

//     if (!response.ok) {
//         throw new Error(json.message || `Error del servidor (${response.status})`)
//     }

//     return json
// }