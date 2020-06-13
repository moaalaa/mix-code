<?php

namespace Tests\Feature\Dashboard\Languages;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Language;
use MixCode\User;

class CreateLanguagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_create_new_language()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin Or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));
        
        // When We Hit The Language Store Endpoint
        $response = $this->postJson(route('dashboard.languages.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Language Store Endpoint
        $response = $this->postJson(route('dashboard.languages.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_create_new_language()
    { 
        // Given We Have An Admin And Language
        $this->signInAsAdmin();
        
        $language = make(Language::class);
        
        // When We Hit The Language Store Endpoint
        $this->postJson(route('dashboard.languages.store'), $language->toArray());
        
        // Then Languages Count Should Be 1
        $this->assertEquals(1, Language::count());
    }

    /** @test */
    public function authenticate_companies_can_create_new_language()
    { 
        // Given We Have A companies And Language
        $this->signIn(create(User::class, ['type' => User::COMPANY_TYPE]));
        
        $language = make(Language::class);
        
        // When We Hit The Language Store Endpoint
        $this->postJson(route('dashboard.languages.store'), $language->toArray());
        
        // Then Languages Count Should Be 1
        $this->assertEquals(1, Language::count());
    }

    /** @test */
    public function language_required_a_valid_en_name()
    {
        $this->createNewLanguage(['en_name' => null])->assertSessionHasErrors('en_name');
    }
    
    /** @test */
    public function language_required_a_valid_ar_name()
    {
        $this->createNewLanguage(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }
        
    protected function createNewLanguage($overrides)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Language
        $this->signInAsAdmin();
 
        $language = make(Language::class, $overrides);
    
        // When We Hit The Language Store Endpoint
        return $this->post(route('dashboard.languages.store'), $language->toArray());
    }
}