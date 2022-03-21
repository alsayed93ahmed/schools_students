<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
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

    public function test_create_student() {
        $response = $this->post('/api/students/store', [
            'name' => 'Ahmed Ahmed',
            'email' => 'ahmed@material.com',
            'school_id' => '1',
        ], [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '. self::$token,
        ]);

        $response->assertStatus(200);
    }

    public function test_destroy_student() {
        $response = $this->delete('/api/students/3', [], [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '. self::$token,
        ]);

        $response->assertStatus(200);
    }
}
