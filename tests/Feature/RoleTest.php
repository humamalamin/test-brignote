<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    private $role;
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

        $this->role = Role::factory()->create(
            [
                'user_id' => $this->user->id,
                'status' => 'active',
                'position' => 'backdor'
            ]
        );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getAllRole()
    {
        $response = $this->get(route('v1.roles.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    '*' => 
                    [
                        'id',
                        'user_id',
                        'position',
                        'status'
                    ]
                ],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_getByID()
    {
        $response = $this->get(route('v1.roles.show', ['rolesId' => $this->role->id]));
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [
                    'id',
                    'user_id',
                    'position',
                    'status'
                ],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_storeSuccess()
    {
        $dataPost = [
            'user_id' => $this->user->id,
            'status' => 'active',
            'position' => 'bct'
        ];

        $response = $this->post(route('v1.roles.create'), $dataPost);
        $response->assertStatus(201);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_storeFailedUserID()
    {
        $dataPost = [
            'user_id' => 0,
            'status' => 'active',
            'position' => 'bct'
        ];

        $response = $this->post(route('v1.roles.create'), $dataPost);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_storeFailedStatus()
    {
        $dataPost = [
            'user_id' => $this->user->id,
            'status' => 'pake',
            'position' => 'bct'
        ];

        $response = $this->post(route('v1.roles.create'), $dataPost);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }
    
    public function test_storeFailedPosition()
    {
        $dataPost = [
            'user_id' => $this->user->id,
            'status' => 'pake',
            'position' => ''
        ];

        $response = $this->post(route('v1.roles.create'), $dataPost);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_editSuccess()
    {
        $dataPost = [
            'status' => 'inactive',
            'position' => 'bct'
        ];

        $response = $this->put(route('v1.roles.edit', ['rolesId' => $this->user->id]), $dataPost);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_editFailedStatus()
    {
        $dataPost = [
            'status' => 'pake',
            'position' => 'bct'
        ];

        $response = $this->put(route('v1.roles.edit', ['rolesId' => $this->role->id]), $dataPost);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_editFailedRoleId()
    {
        $dataPost = [
            'status' => 'inactive',
            'position' => 'bct'
        ];

        $response = $this->put(route('v1.roles.edit', ['rolesId' => 0]), $dataPost);
        $response->assertStatus(404);
        $response->assertJsonStructure(
            [
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_editFailedPosition()
    {
        $dataPost = [
            'status' => 'active',
            'position' => ''
        ];

        $response = $this->put(route('v1.roles.edit', ['rolesId' => $this->role->id]), $dataPost);
        $response->assertStatus(422);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }

    public function test_delete()
    {
        $response = $this->delete(route('v1.roles.delete', ['rolesId' => $this->role->id]));
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' => [],
                'status',
                'message',
                'errors'
            ]
        );
    }
}
