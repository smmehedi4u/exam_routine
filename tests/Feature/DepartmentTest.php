<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_department_route_without_login()
    {
        $response = $this->get('/department');

        $response->assertStatus(302);
    }

    public function test_department_route_with_login()
    {
        $user = User::factory()->create([
            'email' => 'test@gmail.com',
            'email_verified_at' => null,
        ]);
        $response = $this->actingAs($user)->get('/department');

        $response->assertStatus(200);
        $user->delete();
    }
}
