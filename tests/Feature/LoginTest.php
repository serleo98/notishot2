<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        
        $credentials = [
                            "email" => "user@mail.com",
                            "password" => "secret"
                        ];
        $response = $this->post('/login',$credentials)
        ->assertCredentials($credentials)
        ->assertStatus(200);
    }
}
