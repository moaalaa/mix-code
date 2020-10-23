<?php

namespace Tests\Feature\Dashboard\Users;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MixCode\User;

class UpdateUsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');

        $this->user = create(User::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_update_existing_user()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The User Update Endpoint
        $response = $this->patchJson(route('dashboard.users.update', $this->user));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The User Update Endpoint
        $response = $this->patchJson(route('dashboard.users.update', $this->user));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_existing_user()
    {
        // Given We Have An Admin And User
        $this->signInAsAdmin();
        
        // Set User Name
        $updated_data = ['username' => 'Updated User Name'];
        $data = array_merge($this->user->toArray(),  $updated_data);

        // When We Hit The User Update Endpoint
        $response = $this->patchJson(route('dashboard.users.update', $this->user), $data);

        // Then it Should Redirect to the user show page And The User name Should Be Updated
        $response->assertRedirect(route('dashboard.users.show', $this->user));

        $this->assertEquals($updated_data, ['username' => $this->user->fresh()->username]);
    }

    /** @test */
    public function user_required_a_valid_username()
    {
        $this->updateUser(['username' => null])->assertSessionHasErrors('username');
    }

    /** @test */
    public function user_required_a_valid_email()
    {
        $this->updateUser(['email' => null])->assertSessionHasErrors('email');
        $this->updateUser(['email' => 'not-valid-email'])->assertSessionHasErrors('email');
    }


    /** @test */
    public function user_required_a_valid_phone()
    {
        $this->updateUser(['phone' => null])->assertSessionHasErrors('phone');
    }

    /** @test */
    public function user_require_a_valid_type()
    {
        $this->updateUser(['type' => 'not-valid-type'])->assertSessionHasErrors('type');
        $this->updateUser(['type' => null])->assertSessionHasErrors('type');
        $this->updateUser(['type' => User::CUSTOMER_TYPE])->assertSessionHasNoErrors('type');
        $this->updateUser(['type' => User::COMPANY_TYPE])->assertSessionHasNoErrors('type');
        $this->updateUser(['type' => User::ADMIN_TYPE])->assertSessionHasNoErrors('type');
    }
    
    /** @test */
    public function user_require_a_valid_status()
    {
        $this->updateUser(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->updateUser(['status' => null])->assertSessionHasErrors('status');
        $this->updateUser(['status' => User::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->updateUser(['status' => User::PENDING_STATUS])->assertSessionHasNoErrors('status');
        $this->updateUser(['status' => User::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }

    /** @test */
    public function user_may_accept_a_valid_facebook_url()
    {
        $this->updateUser(['facebook' => 'not-valid-url'])->assertSessionHasErrors('facebook');
        $this->updateUser(['facebook' => null])->assertSessionHasNoErrors('facebook');
    }

    /** @test */
    public function user_may_accept_a_valid_twitter_url()
    {
        $this->updateUser(['twitter' => 'not-valid-url'])->assertSessionHasErrors('twitter');
        $this->updateUser(['twitter' => null])->assertSessionHasNoErrors('twitter');
    }

    /** @test */
    public function user_may_accept_a_valid_linkedin_url()
    {
        $this->updateUser(['linkedin' => 'not-valid-url'])->assertSessionHasErrors('linkedin');
        $this->updateUser(['linkedin' => null])->assertSessionHasNoErrors('linkedin');
    }

    /** @test */
    public function user_may_accept_a_valid_instagram_url()
    {
        $this->updateUser(['instagram' => 'not-valid-url'])->assertSessionHasErrors('instagram');
        $this->updateUser(['instagram' => null])->assertSessionHasNoErrors('instagram');
    }

    /** @test */
    public function user_may_accept_a_valid_snapchat_url()
    {
        $this->updateUser(['snapchat' => 'not-valid-url'])->assertSessionHasErrors('snapchat');
        $this->updateUser(['snapchat' => null])->assertSessionHasNoErrors('snapchat');
    }

    /** @test */
    public function user_may_accept_a_valid_youtube_url()
    {
        $this->updateUser(['youtube' => 'not-valid-url'])->assertSessionHasErrors('youtube');
        $this->updateUser(['youtube' => null])->assertSessionHasNoErrors('youtube');
    }

    /** @test */
    public function user_may_accept_a_valid_id_card_file()
    {
        $this->updateUser(['id_card' => 'not-valid-url'])->assertSessionHasErrors('id_card');
        $this->updateUser(['id_card' => null])->assertSessionHasNoErrors('id_card');
    }

    /** @test */
    public function user_may_accept_a_valid_travel_certificate_file()
    {
        $this->updateUser(['travel_certificate' => 'not-valid-url'])->assertSessionHasErrors('travel_certificate');
        $this->updateUser(['travel_certificate' => null])->assertSessionHasNoErrors('travel_certificate');
    }

    /** @test */
    public function user_may_accept_a_valid_tax_card_file()
    {
        $this->updateUser(['tax_card' => 'not-valid-url'])->assertSessionHasErrors('tax_card');
        $this->updateUser(['tax_card' => null])->assertSessionHasNoErrors('tax_card');
    }

    /** @test */
    public function user_may_accept_a_valid_business_register_file()
    {
        $this->updateUser(['business_register' => 'not-valid-url'])->assertSessionHasErrors('business_register');
        $this->updateUser(['business_register' => null])->assertSessionHasNoErrors('business_register');
    }

    /** @test */
    public function user_may_accept_a_valid_logo_image()
    {
        $this->updateUser(['logo' => 'not-valid-url'])->assertSessionHasErrors('logo');
        $this->updateUser(['logo' => null])->assertSessionHasNoErrors('logo');
    }

    /** @test */
    public function user_required_a_valid_password()
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And User without name
        $this->signInAsAdmin();

        // When We Hit The User Update Endpoint
        $response = $this->patch(route('dashboard.users.update.password', $this->user), ['password' => null]);

        // then we except that session has errors for password
        $response->assertSessionHasErrors('password');
    }

    protected function updateUser($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And User without name
        $this->signInAsAdmin();

        $media = [
            'id_card'               => UploadedFile::fake()->create('id_card.pdf'),
            'travel_certificate'    => UploadedFile::fake()->create('travel_certificate.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card.pdf'),
            'business_register'     => UploadedFile::fake()->create('business_register.pdf'),
            'logo'                  => UploadedFile::fake()->create('logo.png'),
        ];

        $media = array_merge($media, $data);

        $data = array_merge($this->user->toArray(), $media);

        // When We Hit The User Update Endpoint
        return $this->patch(route('dashboard.users.update', $this->user), $data);
    }
}
