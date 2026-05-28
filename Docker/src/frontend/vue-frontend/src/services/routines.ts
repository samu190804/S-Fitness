import { getCookie } from "./cookiesCSRF"

export async function createRoutine(params: any) {
  const xsrfToken = getCookie('XSRF-TOKEN')

  let data = JSON.stringify({
    Name: params.Name,
    Dias: params.Dias,
    Duracion: params.Duracion,
    Nivel: params.Nivel,
    Musculos: params.Musculos,
    Descripcion: params.Descripcion,
    CodU: params.CodU,
    ejercicios: params.ejercicios
  })

  const response = await fetch('/api/routines', {
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

export async function deleteRoutine(id: any) {
  const xsrfToken = getCookie('XSRF-TOKEN')

  const response = await fetch(`/api/routines/${id}`, {
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

export async function exercisesfrRoutine(id: any) {
  const response = await fetch(`/api/exercises/routine/${id}`, {
    method: 'GET',
  })
  console.log(response)
  if (!response.ok) throw new Error('Error en la respuesta del servidor');
  return await response.json()
}