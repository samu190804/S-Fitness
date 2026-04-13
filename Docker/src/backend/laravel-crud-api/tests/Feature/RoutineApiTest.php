<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Routine;
use App\Models\Exercise;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutineApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Obtener todas las rutinas
     */
    public function test_can_get_all_routines(): void
    {
        $user = User::factory()->create();
        Routine::factory()->count(3)->create(['CodU' => $user->CodU]);

        $response = $this->getJson('/api/routines');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    /**
     * Test 2: Obtener rutina por ID
     */
    public function test_can_get_single_routine(): void
    {
        $user = User::factory()->create();
        $routine = Routine::factory()->create([
            'CodR' => 500,
            'CodU' => $user->CodU,
            'name' => 'Test Routine',
            'description' => 'Test description'
        ]);

        $response = $this->getJson("/api/routines/500");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         'CodR' => 500,
                         'name' => 'Test Routine'
                     ]
                 ]);
    }

    /**
     * Test 3: Crear rutina
     */
    public function test_can_create_routine(): void
    {
        $user = User::factory()->create();

        $data = [
            'CodU' => $user->CodU,
            'name' => 'New Routine',
            'description' => 'Routine description',
            'duration' => 60,
            'difficulty' => 'intermediate'
        ];

        $response = $this->postJson('/api/routines', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Rutina creada correctamente'
                 ]);

        $this->assertDatabaseHas('routines', [
            'name' => 'New Routine',
            'CodU' => $user->CodU
        ]);
    }

    /**
     * Test 4: Actualizar rutina
     */
    public function test_can_update_routine(): void
    {
        $user = User::factory()->create();
        $routine = Routine::factory()->create([
            'CodR' => 600,
            'name' => 'Old Name'
        ]);

        $data = [
            'name' => 'Updated Name',
            'duration' => 90
        ];

        $response = $this->putJson("/api/routines/600", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Rutina actualizada correctamente'
                 ]);
    }

    /**
     * Test 5: Eliminar rutina
     */
    public function test_can_delete_routine(): void
    {
        $routine = Routine::factory()->create(['CodR' => 700]);

        $response = $this->deleteJson("/api/routines/700");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Rutina eliminada correctamente'
                 ]);

        $this->assertDatabaseMissing('routines', ['CodR' => 700]);
    }

    /**
     * Test 6: Obtener rutinas de un usuario
     */
    public function test_can_get_routines_by_user(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Routine::factory()->count(2)->create(['CodU' => $user1->CodU]);
        Routine::factory()->count(3)->create(['CodU' => $user2->CodU]);

        $response = $this->getJson("/api/routines/user/{$user1->CodU}");

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }
}