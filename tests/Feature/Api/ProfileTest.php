<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase; // Resets the database after each test runs

    /**
     * Test that an unauthenticated user cannot access the profile endpoint.
     */
    public function test_unauthenticated_user_cannot_access_profile(): void
    {
        $response = $this->getJson('/api/profile');

        // Asserts that the status is 401 Unauthorized
        $response->assertStatus(401);
    }

    /**
     * Test that an authenticated user can successfully retrieve their profile data.
     */
    public function test_authenticated_user_can_retrieve_profile(): void
    {
        // 1. Create a dummy user using model factories
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // 2. Act as the logged-in user (Sanctum will mock the bearer token)
        $response = $this->actingAs($user, 'sanctum')->getJson('/api/profile');

        // 3. Assertions
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'joined_at'
                ]
            ])
            ->assertJsonFragment([
                'name' => 'John Doe',
                'email' => 'john@example.com',
            ]);
    }
}
