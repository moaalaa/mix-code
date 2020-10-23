<?php

namespace Tests\Feature\Api\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MixCode\User;

class RegisterApiTest extends TestCase
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
    public function guest_customer_can_create_new_account_from_api()
    {
        $this->withExceptionHandling();
        
        // Given we have a customer
        $customer     = make(User::class, ['type' => User::CUSTOMER_TYPE, 'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        
        // When We hit api register endpoint
        $this->postJson(route('api.register'), $customer->makeVisible(['password'])->toArray())
        ->assertStatus(Response::HTTP_CREATED);

        // Then We Should See the customer saved in Database
        
        $this->assertEquals(1, User::count());
        $this->assertTrue($customer->isCustomer());
        $this->assertDatabaseHas('users', ['username' => $customer->username]);
    }
    
    /** @test */
    public function guest_company_can_create_new_account_from_api()
    {
        // Given we have a Company
        $company    = make(User::class, ['type' => User::COMPANY_TYPE, 'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        
        $media = [
            'id_card'               => UploadedFile::fake()->create('id_card.pdf'),
            'travel_certificate'    => UploadedFile::fake()->create('travel_certificate.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card.pdf'),
            'business_register'     => UploadedFile::fake()->create('business_register.pdf'),
            'logo'                  => UploadedFile::fake()->create('logo.png'),
        ];

        $data = array_merge($company->makeVisible(['password'])->toArray(), $media);


        // When We hit register endpoint
        $this->postJson(route('api.register'), $data)
        ->assertStatus(Response::HTTP_CREATED);
        
        // Then We Should See the company saved in Database
        $this->assertEquals(1, User::count());
        $this->assertTrue($company->isCompany());
        $this->assertDatabaseHas('users', ['username' => $company->username]);
    }

    
    /** @test */
    public function user_required_a_valid_username()
    {
        $this->registerUser(['username' => null])
            ->assertJsonValidationErrors('username')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function user_required_a_valid_email()
    {
        $this->registerUser(['email' => null])
            ->assertJsonValidationErrors('email')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['email' => 'not-valid-email'])
            ->assertJsonValidationErrors('email')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function user_required_a_valid_password()
    {
        $this->registerUser(['password' => null])
            ->assertJsonValidationErrors('password')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function user_required_a_valid_phone()
    {
        $this->registerUser(['phone' => null])
            ->assertJsonValidationErrors('phone')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function user_require_a_valid_type()
    {
        $this->registerUser(['type' => 'not-valid-type'])
            ->assertJsonValidationErrors('type')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['type' => null])
            ->assertJsonValidationErrors('type')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['type' => User::CUSTOMER_TYPE])->assertJsonMissingValidationErrors('type');
        $this->registerUser(['type' => User::COMPANY_TYPE])->assertJsonMissingValidationErrors('type');
    }
    
    /** @test */
    public function user_may_accept_a_valid_facebook_url()
    {
        $this->registerUser(['facebook' => 'not-valid-url'])
            ->assertJsonValidationErrors('facebook')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['facebook' => null])
            ->assertJsonMissingValidationErrors('facebook');
    }
    
    /** @test */
    public function user_may_accept_a_valid_twitter_url()
    {
        $this->registerUser(['twitter' => 'not-valid-url'])
            ->assertJsonValidationErrors('twitter')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['twitter' => null])->assertJsonMissingValidationErrors('twitter');
    }
    
    /** @test */
    public function user_may_accept_a_valid_linkedin_url()
    {
        $this->registerUser(['linkedin' => 'not-valid-url'])
            ->assertJsonValidationErrors('linkedin')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['linkedin' => null])->assertJsonMissingValidationErrors('linkedin');
    }
    
    /** @test */
    public function user_may_accept_a_valid_instagram_url()
    {
        $this->registerUser(['instagram' => 'not-valid-url'])
            ->assertJsonValidationErrors('instagram')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['instagram' => null])->assertJsonMissingValidationErrors('instagram');
    }
    
    /** @test */
    public function user_may_accept_a_valid_snapchat_url()
    {
        $this->registerUser(['snapchat' => 'not-valid-url'])
            ->assertJsonValidationErrors('snapchat')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['snapchat' => null])->assertJsonMissingValidationErrors('snapchat');
    }
    
    /** @test */
    public function user_may_accept_a_valid_youtube_url()
    {
        $this->registerUser(['youtube' => 'not-valid-url'])
            ->assertJsonValidationErrors('youtube')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['youtube' => null])->assertJsonMissingValidationErrors('youtube');
    }
    
    /** @test */
    public function user_may_accept_a_valid_id_card_file()
    {
        $this->registerUser(['id_card' => 'not-valid-url'])
            ->assertJsonValidationErrors('id_card')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['id_card' => null])->assertJsonMissingValidationErrors('id_card');
    }
    
    /** @test */
    public function user_may_accept_a_valid_travel_certificate_file()
    {
        $this->registerUser(['travel_certificate' => 'not-valid-url'])
            ->assertJsonValidationErrors('travel_certificate')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['travel_certificate' => null])->assertJsonMissingValidationErrors('travel_certificate');
    }
    
    /** @test */
    public function user_may_accept_a_valid_tax_card_file()
    {
        $this->registerUser(['tax_card' => 'not-valid-url'])
            ->assertJsonValidationErrors('tax_card')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['tax_card' => null])->assertJsonMissingValidationErrors('tax_card');
    }
    
    /** @test */
    public function user_may_accept_a_valid_business_register_file()
    {
        $this->registerUser(['business_register' => 'not-valid-url'])
            ->assertJsonValidationErrors('business_register')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['business_register' => null])->assertJsonMissingValidationErrors('business_register');
    }
    
    /** @test */
    public function user_may_accept_a_valid_logo_image()
    {
        $this->registerUser(['logo' => 'not-valid-url'])
            ->assertJsonValidationErrors('logo')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->registerUser(['logo' => null])->assertJsonMissingValidationErrors('logo');
    }
    
    protected function registerUser($overrides)
    {
        $this->withExceptionHandling();

        $media = [
            'id_card'               => UploadedFile::fake()->create('id_card.pdf'),
            'travel_certificate'    => UploadedFile::fake()->create('travel_certificate.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card.pdf'),
            'business_register'     => UploadedFile::fake()->create('business_register.pdf'),
            'logo'                  => UploadedFile::fake()->create('logo.png'),
        ];

        // Given We Have a User
        $overrides = array_merge($media, $overrides, ['password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        $user = make(User::class, $overrides);
    
        // When We Hit The User Register Endpoint
        return $this->postJson(route('api.register'), $user->makeVisible('password')->toArray());
    }
}