<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchoolTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected static $token = null;
    public function test_login()
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@material.com',
            'password' => 'secret',
        ], [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ]);
        self::$token = $response['token'];
        $response->assertStatus(200);
    }

    public function test_create_school() {
        $response = $this->post('/api/schools/store', [
            'name' => 'New School',
        ], [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '. self::$token,
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy_school() {
        $response = $this->delete('/api/schools/3', [], [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '. self::$token,
        ]);

        $response->assertStatus(200);
    }
}
