<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Exercise;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExerciseApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Obtener todos los ejercicios
     */
    public function test_can_get_all_exercises(): void
    {
        $user = User::factory()->create();
        Exercise::factory()->count(3)->create(['CodU' => $user->CodU]);

        $response = $this->getJson('/api/exercises');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                 ])
                 ->assertJsonCount(3, 'data');
    }

    /**
     * Test 2: Obtener ejercicio por ID
     */
    public function test_can_get_single_exercise(): void
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create([
            'CodE' => 100,
            'CodU' => $user->CodU,
            'name' => 'Test Exercise',
            'description' => 'Test description',
            'type' => 'strength',
            'repetitions' => 10,
            'sets' => 3
        ]);

        $response = $this->getJson("/api/exercises/100");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         'CodE' => 100,
                         'name' => 'Test Exercise'
                     ]
                 ]);
    }

    /**
     * Test 3: Crear ejercicio
     */
    public function test_can_create_exercise(): void
    {
        $user = User::factory()->create();

        $data = [
            'CodU' => $user->CodU,
            'name' => 'New Exercise',
            'description' => 'Exercise description',
            'type' => 'cardio',
            'repetitions' => 15,
            'sets' => 4,
            'duration' => 30,
            'level' => 'intermediate'
        ];

        $response = $this->postJson('/api/exercises', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Ejercicio creado correctamente'
                 ]);

        $this->assertDatabaseHas('exercises', [
            'name' => 'New Exercise',
            'CodU' => $user->CodU
        ]);
    }

    /**
     * Test 4: Validar campos requeridos al crear ejercicio
     */
    public function test_exercise_requires_required_fields(): void
    {
        $response = $this->postJson('/api/exercises', [
            'CodU' => 999
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'type']);
    }

    /**
     * Test 5: Actualizar ejercicio
     */
    public function test_can_update_exercise(): void
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create([
            'CodE' => 200,
            'CodU' => $user->CodU,
            'name' => 'Old Name'
        ]);

        $data = [
            'name' => 'Updated Name',
            'description' => 'Updated description',
            'repetitions' => 20
        ];

        $response = $this->putJson("/api/exercises/200", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Ejercicio actualizado correctamente'
                 ]);

        $this->assertDatabaseHas('exercises', [
            'CodE' => 200,
            'name' => 'Updated Name',
            'repetitions' => 20
        ]);
    }

    /**
     * Test 6: Eliminar ejercicio
     */
    public function test_can_delete_exercise(): void
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create(['CodE' => 300]);

        $response = $this->deleteJson("/api/exercises/300");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Ejercicio eliminado correctamente'
                 ]);

        $this->assertDatabaseMissing('exercises', ['CodE' => 300]);
    }

    /**
     * Test 7: Filtrar ejercicios por tipo
     */
    public function test_can_filter_exercises_by_type(): void
    {
        $user = User::factory()->create();
        
        Exercise::factory()->create(['CodU' => $user->CodU, 'type' => 'strength']);
        Exercise::factory()->create(['CodU' => $user->CodU, 'type' => 'cardio']);
        Exercise::factory()->create(['CodU' => $user->CodU, 'type' => 'strength']);

        $response = $this->getJson('/api/exercises/filter?type=strength');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }

    /**
     * Test 8: Obtener ejercicios de una rutina
     */
    public function test_can_get_exercises_from_routine(): void
    {
        // Implementar según tu método ejerciciosDeRutina
        $response = $this->getJson('/api/exercises/routine/1');
        
        $response->assertStatus(200);
    }
}