# Guía de Tests para API S-Fitness

Esta documentación contiene todos los tests necesarios para validar la API REST del backend Laravel.

---

## 📋 Configuración del Entorno de Testing

### Archivo: `phpunit.xml`

El archivo ya está configurado con:
- Base de datos SQLite en memoria (`DB_DATABASE=:memory:`)
- Entorno de testing (`APP_ENV=testing`)
- Cache en array para no persistencia

### Archivo: `tests/TestCase.php`

Configuración base para todos los tests:

```php
<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
}
```

**Importante**: El trait `RefreshDatabase` asegura que cada test use una base de datos limpia.

---

## 🧪 Tests a Implementar

### 1. UserApiTest.php

**Propósito**: Validar todos los endpoints relacionados con usuarios.

**Tests incluidos**:

| # | Test | Método HTTP | Endpoint | Descripción |
|---|------|-------------|----------|-------------|
| 1 | `test_can_get_all_users` | GET | `/api/users` | Obtener lista de usuarios |
| 2 | `test_can_get_single_user` | GET | `/api/users/{id}` | Obtener usuario específico |
| 3 | `test_can_create_user` | POST | `/api/users` | Crear usuario válido |
| 4 | `test_cannot_create_user_with_duplicate_email` | POST | `/api/users` | Validar email duplicado |
| 5 | `test_can_update_user` | PUT | `/api/users/{id}` | Actualizar usuario |
| 6 | `test_can_delete_user` | DELETE | `/api/users/{id}` | Eliminar usuario |
| 7 | `test_can_upload_profile_photo` | POST | `/api/users/{id}/photo` | Subir foto de perfil |
| 8 | `test_email_and_username_must_be_unique` | POST | `/api/users` | Validar unicidad email/userName |


### 2. ExerciseApiTest.php

**Propósito**: Validar todos los endpoints relacionados con ejercicios.

**Tests incluidos**:

| # | Test | Método HTTP | Endpoint | Descripción |
|---|------|-------------|----------|-------------|
| 1 | `test_can_get_all_exercises` | GET | `/api/exercises` | Obtener lista de ejercicios |
| 2 | `test_can_get_single_exercise` | GET | `/api/exercises/{id}` | Obtener ejercicio específico |
| 3 | `test_can_create_exercise` | POST | `/api/exercises` | Crear ejercicio válido |
| 4 | `test_exercise_requires_required_fields` | POST | `/api/exercises` | Validar campos requeridos |
| 5 | `test_can_update_exercise` | PUT | `/api/exercises/{id}` | Actualizar ejercicio |
| 6 | `test_can_delete_exercise` | DELETE | `/api/exercises/{id}` | Eliminar ejercicio |
| 7 | `test_can_filter_exercises_by_type` | GET | `/api/exercises/filter` | Filtrar por tipo |
| 8 | `test_can_get_exercises_from_routine` | GET | `/api/exercises/routine/{codR}` | Ejercicios de rutina |

### 3. RoutineApiTest.php

**Propósito**: Validar todos los endpoints relacionados con rutinas.

**Tests incluidos**:

| # | Test | Método HTTP | Endpoint | Descripción |
|---|------|-------------|----------|-------------|
| 1 | `test_can_get_all_routines` | GET | `/api/routines` | Obtener lista de rutinas |
| 2 | `test_can_get_single_routine` | GET | `/api/routines/{id}` | Obtener rutina específica |
| 3 | `test_can_create_routine` | POST | `/api/routines` | Crear rutina válida |
| 4 | `test_can_update_routine` | PUT | `/api/routines/{id}` | Actualizar rutina |
| 5 | `test_can_delete_routine` | DELETE | `/api/routines/{id}` | Eliminar rutina |
| 6 | `test_can_get_routines_by_user` | GET | `/api/routines/user/{codU}` | Rutinas de un usuario |

## 🚀 Comandos para Ejecutar Tests

### Ejecutar todos los tests

```bash
php artisan test
```

### Ejecutar tests de un archivo específico

```bash
php artisan test tests/Feature/UserApiTest.php
php artisan test tests/Feature/ExerciseApiTest.php
php artisan test tests/Feature/RoutineApiTest.php
```

### Ejecutar un test específico

```bash
php artisan test --filter=test_can_create_user
php artisan test --filter=test_can_update_exercise
php artisan test --filter=test_can_delete_routine
```

### Ejecutar tests con verbose output

```bash
php artisan test --verbose
```

### Ejecutar tests con cobertura de código (requiere Xdebug)

```bash
php artisan test --coverage
```

---

## 📊 Resumen de Tests

| Archivo | Tests | Estado |
|---------|-------|--------|
| `UserApiTest.php` | 8 tests | ✅ CRUD completo + foto perfil + validaciones |
| `ExerciseApiTest.php` | 8 tests | ✅ CRUD + filtros + ejercicios por rutina |
| `RoutineApiTest.php` | 6 tests | ✅ CRUD + rutinas por usuario |
| **TOTAL** | **22 tests** | ✅ Cobertura completa de API |

---

## 🎯 Assertions Más Utilizados

### Assertions de HTTP

```php
$response->assertStatus(200);           // Verificar código de estado
$response->assertStatus(201);           // Verificar creación
$response->assertStatus(422);           // Verificar error de validación
```

### Assertions de JSON

```php
$response->assertJson(['success' => true]);
$response->assertJsonCount(3, 'data');
$response->assertJsonMissing(['password']);
```

### Assertions de Validación

```php
$response->assertJsonValidationErrors('email');
$response->assertJsonValidationErrors(['name', 'type']);
```

### Assertions de Base de Datos

```php
$this->assertDatabaseHas('usuarios', ['email' => 'test@example.com']);
$this->assertDatabaseMissing('usuarios', ['CodU' => 789]);
```

### Assertions de Archivos

```php
Storage::disk('public')->assertExists('profile-photos/999/avatar.jpg');
Storage::disk('public')->assertMissing('profile-photos/999/old.jpg');
```

---

## 💡 Consejos para Escribir Tests

1. **Nombres descriptivos**: Los tests deben explicar qué se está probando
2. **Un concepto por test**: Cada test debe validar una sola cosa
3. **Datos de prueba realistas**: Usa factories para crear datos consistentes
4. **Limpieza automática**: `RefreshDatabase` se encarga de limpiar la BD
5. **Testea casos borde**: Validaciones, errores, datos inválidos

---

## 📝 Referencias

- [Laravel Testing Documentation](https://laravel.com/docs/testing)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Laravel HTTP Tests](https://laravel.com/docs/http-tests)

---

**Fecha de creación**: 13 de abril de 2026  
**Proyecto**: S-Fitness TFG  
**Backend**: Laravel 12.x
