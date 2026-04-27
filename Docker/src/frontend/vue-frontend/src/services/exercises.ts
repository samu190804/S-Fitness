export async function fetchExercises() {
  const response = await fetch('http://localhost:8080/api/exercises');
  if (!response.ok) throw new Error('Error en la respuesta del servidor');
  return await response.json();
}

// function mostrarEjercicios() {

//     fetch('http://localhost:8080/api/exercises', {
//         method: 'GET',
//     })
//         .then(response => {
//             if (!response.ok) {
//                 resultado.value = 'Error en la respuesta del servidor';
//                 throw new Error('Error en la respuesta del servidor');
//             }
//             return response.json();
//         })
//         .then(json => {
//             return query = json
//         })
//         .catch(error => {
//             resultado.value = "Sin resultado";
//             console.error('Error al obtener los datos:', error)
//         });
// }

// mostrarConFiltros($isUserC) {

//     app.resultado = '';
//     app.descripcion = '';
//     app.parametrosQuery.Qtipo = app.tipo;

//     if ($isUserC) {
//         app.parametrosQuery.QCodU = app.userData.userCodU;
//     } else {
//         app.parametrosQuery.QCodU = null;
//     }


//     fetch('Php/mostrarEjerciciosRutinas.php', {
//         method: 'POST', // Método POST
//         headers: {
//             'Content-Type': 'application/json' // Tipo de contenido JSON
//         },
//         body: JSON.stringify(app.parametrosQuery)
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
//             if (app.tipo == 'Ejercicios') {
//                 this.ejercicios = json;
//             }
//             if (app.tipo == 'Rutinas') {
//                 this.rutinas = json;
//             }

//         })
//         .catch(error => {
//             app.resultado = "Sin resultados";
//             console.error('Error al obtener los datos:', error)
//         });
// },

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