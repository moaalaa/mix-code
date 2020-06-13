<?php

namespace Tests\Feature\Dashboard\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\User;

class DeleteUsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = create(User::class)->makeHidden(['allUserMedia', 'media']);
    }

    /** @test */
    public function non_authenticate_administrators_cant_delete_existing_user()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The User Delete Endpoint
        $response = $this->deleteJson(route('dashboard.users.destroy', $this->user));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The User Delete Endpoint
        $response = $this->deleteJson(route('dashboard.users.destroy', $this->user));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_user()
    { 
        // Given We Have An Admin And User
        $this->signInAsAdmin();
        
        // When We Hit The User Delete Endpoint
        $response = $this->deleteJson(route('dashboard.users.destroy', $this->user));
                
        // Then it Should Redirect to the user index page after delete the user
        $response->assertRedirect(route('dashboard.users.index'));
        $this->assertDatabaseMissing('users', $this->user->toArray());
        $this->assertEquals(1, User::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_existing_user()
    { 
        // Given We Have An Admin And Deleted User
        $this->signInAsAdmin();

        $this->user->delete();

        // When We Hit The User Delete Endpoint
        $response = $this->patchJson(route('dashboard.users.restore', $this->user));
                
        // Then it Should Redirect to the user trashed index page after delete the user
        $response->assertRedirect(route('dashboard.users.trashed'));
        $this->assertEquals(2, User::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_user_forever()
    { 
        // Given We Have An Admin And Deleted User
        $this->signInAsAdmin();
        
        $this->user->delete();
        
        // When We Hit The User Delete Endpoint
        $response = $this->deleteJson(route('dashboard.users.force_delete', $this->user));
        
        // Then it Should Redirect to the user trashed index page after delete the user
        $response->assertRedirect(route('dashboard.users.trashed'));
        $this->assertEquals(1, User::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_administrators_can_multi_delete_existing_users()
    { 
        // Given We Have An Admin And Users
        $this->signInAsAdmin();
        $ids = create(User::class, [], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->user->id]);
        // When We Hit The User multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.users.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the user index page after delete the user
        $response->assertRedirect(route('dashboard.users.index'));
        $this->assertDatabaseMissing('users', $ids);
        $this->assertEquals(1, User::count());
    }
}