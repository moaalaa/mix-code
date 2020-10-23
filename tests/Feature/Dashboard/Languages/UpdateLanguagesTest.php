<?php

namespace Tests\Feature\Dashboard\Languages;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Language;
use MixCode\User;

class UpdateLanguagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = create(User::class, ['type' => User::ADMIN_TYPE]);
        $this->adminLanguage = create(Language::class, ['creator_id' => $this->admin->id]);
        
        $this->company = create(User::class, ['type' => User::COMPANY_TYPE]);
        $this->companyLanguage = create(Language::class, ['creator_id' => $this->company->id]);
    
        $this->language = create(Language::class);
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_update_existing_language()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin Or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The Language Update Endpoint
        $response = $this->patchJson(route('dashboard.languages.update', $this->language));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Language Update Endpoint
        $response = $this->patchJson(route('dashboard.languages.update', $this->language));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_their_existing_language()
    {
        // Given We Have An Admin And Language
        $this->signInAsAdmin($this->admin);
        
        // Set Language Name
        $updated_data = ['en_name' => 'Updated Language Name'];
        $data = array_merge($this->adminLanguage->toArray(),  $updated_data);

        // When We Hit The Language Update Endpoint
        $response = $this->patchJson(route('dashboard.languages.update', $this->adminLanguage), $data);

        // Then it Should Redirect to the language show page And The Language name Should Be Updated
        $response->assertRedirect($this->adminLanguage->path());

        $this->assertEquals($updated_data, ['en_name' => $this->adminLanguage->fresh()->en_name]);
    }

    /** @test */
    public function authenticate_companies_can_update_their_existing_language()
    {
        // Given We Have A Company And Language
        $this->signIn($this->company);
        
        // Set Language Name
        $updated_data = ['en_name' => 'Updated Language Name'];
        $data = array_merge($this->companyLanguage->toArray(),  $updated_data);

        // When We Hit The Language Update Endpoint
        $response = $this->patchJson(route('dashboard.languages.update', $this->companyLanguage), $data);

        // Then it Should Redirect to the language show page And The Language name Should Be Updated
        $response->assertRedirect($this->companyLanguage->path());

        $this->assertEquals($updated_data, ['en_name' => $this->companyLanguage->fresh()->en_name]);
    }

    /** @test */
    public function language_required_a_valid_en_name()
    {
        $this->updateLanguage(['en_name' => null])->assertSessionHasErrors('en_name');
    }

    /** @test */
    public function language_required_a_valid_ar_name()
    {
        $this->updateLanguage(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }

    protected function updateLanguage($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Language
        $this->signInAsAdmin();

        $data = array_merge($this->language->toArray(), $data);

        // When We Hit The Language Update Endpoint
        return $this->patch(route('dashboard.languages.update', $this->language), $data);
    }
}
