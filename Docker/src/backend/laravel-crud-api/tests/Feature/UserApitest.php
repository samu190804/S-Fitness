<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Obtener lista de usuarios
     */
    public function test_can_get_all_users(): void
    {
        // Crear usuarios de prueba
        User::factory()->count(3)->create();

        // Hacer petición GET
        $response = $this->getJson('/api/users');

        // Verificar respuesta
        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                 ])
                 ->assertJsonCount(3, 'data');
    }

    /**
     * Test 2: Obtener un usuario específico
     */
    public function test_can_get_single_user(): void
    {
        $user = User::factory()->create([
            'CodU' => 123,
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);

        $response = $this->getJson("/api/users/123");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'data' => [
                         'CodU' => 123,
                         'name' => 'Test User',
                         'email' => 'test@example.com'
                     ]
                 ]);
    }

    /**
     * Test 3: Crear usuario válido
     */
    public function test_can_create_user(): void
    {
        $data = [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'userName' => 'newuser',
            'biography' => 'Test biography'
        ];

        $response = $this->postJson('/api/users', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Usuario creado correctamente'
                 ]);

        // Verificar que se creó en BD
        $this->assertDatabaseHas('usuarios', [
            'email' => 'newuser@example.com',
            'userName' => 'newuser'
        ]);
    }

    /**
     * Test 4: Validar creación de usuario (email duplicado)
     */
    public function test_cannot_create_user_with_duplicate_email(): void
    {
        User::factory()->create(['email' => 'existing@example.com']);

        $data = [
            'name' => 'Duplicate User',
            'email' => 'existing@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'userName' => 'duplicateuser'
        ];

        $response = $this->postJson('/api/users', $data);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('email');
    }

    /**
     * Test 5: Actualizar usuario
     */
    public function test_can_update_user(): void
    {
        $user = User::factory()->create([
            'CodU' => 456,
            'name' => 'Old Name',
            'email' => 'old@example.com'
        ]);

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'biography' => 'Updated bio'
        ];

        $response = $this->putJson("/api/users/456", $data);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Usuario actualizado correctamente'
                 ]);

        $this->assertDatabaseHas('usuarios', [
            'CodU' => 456,
            'name' => 'Updated Name',
            'email' => 'updated@example.com'
        ]);
    }

    /**
     * Test 6: Eliminar usuario
     */
    public function test_can_delete_user(): void
    {
        $user = User::factory()->create(['CodU' => 789]);

        $response = $this->deleteJson("/api/users/789");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Usuario eliminado correctamente'
                 ]);

        $this->assertDatabaseMissing('usuarios', ['CodU' => 789]);
    }

    /**
     * Test 7: Subir foto de perfil
     */
    public function test_can_upload_profile_photo(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['CodU' => 999]);

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->postJson("/api/users/999/photo", [
            'photo' => $file
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Foto de perfil subida correctamente'
                 ]);

        // Verificar que el archivo existe
        $this->assertTrue(
            Storage::disk('public')->exists('profile-photos/999/avatar.jpg'),
            'El archivo de foto de perfil debería existir'
        );
    }

    /**
     * Test 8: Verificar email y userName únicos
     */
    public function test_email_and_username_must_be_unique(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'userName' => 'testuser'
        ]);

        // Test email duplicado
        $response = $this->postJson('/api/users', [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'userName' => 'newuser'
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('email');

        // Test userName duplicado
        $response = $this->postJson('/api/users', [
            'name' => 'Test',
            'email' => 'new@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'userName' => 'testuser'
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('userName');
    }
}