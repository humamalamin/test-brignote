<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(
            [
            'email' => 'test@example.com',
            'password' => bcrypt('password')
            ]
        );
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSeeLoginPage()
    {
        $response = $this->get('/login');
        $response->assertSee('LOGIN');
        $response->assertStatus(200);
    }

    // public function testCanLogin()
    // {
    //     $dataForm = [
    //         'email' => $this->user->email,
    //         'password' => 'password'
    //     ];

    //     $this->get('/login')
    //         ->assertSee('LOGIN')
    //         ->submitForm('login', $dataForm)
    //         ->assertStatus(200);
    // }
}
