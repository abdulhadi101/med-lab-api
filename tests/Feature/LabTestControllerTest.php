<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class LabTestControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_lab_tests_endpoint_requires_authentication()
    {
        $response = $this->getJson('/api/lab-tests');

        $response->assertStatus(401); // 401 Unauthorized
    }

    /** @test */
    public function test_submit_medical_data_endpoint_requires_authentication()
    {
        $response = $this->postJson('/api/submit-medical-data', [
            'test_data' => 'Sample Data',
        ]);

        $response->assertStatus(401); // 401 Unauthorized
    }

    /** @test */
    public function test_authenticated_user_can_access_lab_tests_endpoint()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->getJson('/api/lab-tests');

        $response->assertStatus(200); // Assuming success if authenticated

    }

    /** @test */
    public function test_authenticated_user_can_submit_medical_data()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/submit-medical-data', [
            'username' => $user->username,
            'data' => [ 'age' => 21, 'height' => '1.6' ]
        ]);

        $response->assertStatus(200); // Assuming success if authenticated

    }

    /** @test */
    public function test_user_can_logout()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200); // Assuming success if authenticated
        $response->assertJson([
            'message' => 'Logged out successfully',
        ]);
    }
}
