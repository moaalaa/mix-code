<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use MixCode\User;

class LoginApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Every Request We Must Install Passport Clients Key to make a success token creation
        \Artisan::call('passport:install',['-vvv' => true]);

        Storage::fake('test');
    }

    /** @test */
    public function user_can_login_from_api()
    {   
        // Given we have a user
        create(User::class, ['email' => 'test@email.com', 'password' => Hash::make('123456')]);
        
        // When We hit api login endpoint
        $res = $this->postJson(route('api.login'), ['email' =>' test@email.com', 'password' => '123456']);
        
        // Then We Should See the token created
        $res->assertStatus(Response::HTTP_OK);

    }
    
    /** @test */
    public function user_required_a_valid_email()
    {
        $this->loginUser(['email' => null])
            ->assertJsonValidationErrors('email')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->loginUser(['email' => 'not-valid-email'])
            ->assertJsonValidationErrors('email')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function user_required_a_valid_password()
    {
        $this->loginUser(['password' => null])
            ->assertJsonValidationErrors('password')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
   
    protected function loginUser($overrides)
    {
        $this->withExceptionHandling();
        
        // Given We Have a User
        $user = make(User::class, $overrides);
    
        // When We Hit The User Login Endpoint
        return $this->postJson(route('api.login'), ['email' => $user->email, 'password' => $user->password]);
    }
}