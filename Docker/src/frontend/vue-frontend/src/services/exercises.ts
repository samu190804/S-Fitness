import { getCookie } from "./cookiesCSRF";

export async function fetchExercises() {
  const response = await fetch('/api/exercises', {
    method: 'GET',
  })
  if (!response.ok) throw new Error('Error en la respuesta del servidor');
  return await response.json()
}

export async function fetchFilter(params: any, type: number) {

  const urlBase = type ? '/api/routines' : '/api/exercises'
  const queryParams = new URLSearchParams()

  for (const [key, value] of Object.entries(params)) {
    if (value !== null && value !== undefined && value !== '') {
      queryParams.append(key, String(value))
    }
  }

  const url = `${urlBase}/filter?${queryParams.toString()}`

  const response = await fetch(url, {
    method: 'GET'
  })

  if (!response.ok) throw new Error('Error en la respuesta del servidor');
  return await response.json()
}

export async function createExer(params: any) {
  const xsrfToken = getCookie('XSRF-TOKEN')

  let data = JSON.stringify({
    Name: params.Name,
    Musculo: params.Musculo,
    Series: params.Series,
    Repeticiones: params.Repeticiones,
    Descripcion: params.Descripcion,
    Video: params.Video,
    CodU: params.CodU
  })

  const response = await fetch('/api/exercises', {
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

export async function deleteExer(id: any) {
    const xsrfToken = getCookie('XSRF-TOKEN')

    const response = await fetch(`/api/exercises/${id}`, {
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

export function getEmbedUrl(url: string): string {
  if (!url) return ''
  // Convierte watch?v=ID a embed/ID
  const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/)
  if (match) {
    return `https://www.youtube.com/embed/${match[1]}`
  }
  return url // si ya es embed o no es youtube, la devuelve tal cual
}