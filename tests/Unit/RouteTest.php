<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_firstPage()
    {
        $response = $this->get('/');
        $response->assertRedirect('login')
            ->assertStatus(302);
    }

    public function test_registerPage()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('REGISTER');
    }
}
