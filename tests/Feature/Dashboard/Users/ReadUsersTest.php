<?php

namespace Tests\Feature\Dashboard\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\User;

class ReadUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_read_single_user()
    {
        $this->readUser(route('dashboard.users.show', create(User::class)));
    }

    /** @test */
    public function non_authenticate_administrators_cant_read_all_user()
    {
        $this->readUser(route('dashboard.users.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_single_user()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $user = create(User::class);

        // When We Hit The User Read Endpoint
        $response = $this->getJson(route('dashboard.users.show', $user));
        
        // Then It Should Get The User That Was Created
        $response->assertOk();
        $this->assertEquals($user->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_all_user()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $users = create(User::class, [], 3);

        // When We Hit The User Read Endpoint
        $response = $this->getJson(route('dashboard.users.index'));
        
        // Then It Should Get The "4" Users That Was Created
        $response->assertOk();
        $response->assertSee($users->first()->username);
        $response->assertSee($users->get(1)->username);
        $response->assertSee($users->last()->username);
    }

    protected function readUser($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The User Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The User Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}