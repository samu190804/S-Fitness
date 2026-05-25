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

export function getEmbedUrl(url: string): string {
  if (!url) return ''
  // Convierte watch?v=ID a embed/ID
  const match = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/)
  if (match) {
    return `https://www.youtube.com/embed/${match[1]}`
  }
  return url // si ya es embed o no es youtube, la devuelve tal cual
}

// mostrarEjerciciosRutina(codR, name, userName, desc) {

//     app.tipo = "Ejercicios";
//     app.resultado = "Estas viendo una rutina de '" + userName + "'. Nombre: " + name + ".";
//     app.descripcion = "Descripción: " + desc;

//     fetch('Php/EjerciciosDeRutina.php', {
//         method: 'POST', // Método POST
//         headers: {
//             'Content-Type': 'application/json' // Tipo de contenido JSON
//         },
//         body: JSON.stringify(codR)
//     })
//         .then(response => {
//             if (!response.ok) {
//                 app.resultado = 'Error en la respuesta del servidor';
//                 throw new Error('Error en la respuesta del servidor');
//             }
//             //console.log(response.text());
//             return response.json();
//         })
//         .then(json => {

//             this.ejercicios = json;

//         })
//         .catch(error => {
//             app.resultado = "Sin resultados";
//             console.error('Error al obtener los datos:', error)
//         });
// }