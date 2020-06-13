<?php

namespace Tests\Feature\Dashboard\Languages;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Language;
use MixCode\User;

class ReadLanguagesTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = create(User::class, ['type' => User::ADMIN_TYPE]);
        $this->adminLanguage = create(Language::class, ['creator_id' => $this->admin->id]);
        
        $this->company = create(User::class, ['type' => User::COMPANY_TYPE]);
        $this->companyLanguage = create(Language::class, ['creator_id' => $this->company->id]);
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_read_single_language()
    {
        $this->readLanguage(create(Language::class)->path());
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_read_all_language()
    {
        $this->readLanguage(route('dashboard.languages.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_their_single_language()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin($this->admin);

        // When We Hit The Language Read Endpoint
        $response = $this->getJson($this->adminLanguage->path());
        
        // Then It Should Get The Language That Was Created
        $response->assertOk();
        $this->assertEquals($this->adminLanguage->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_all_their_language()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin($this->admin);
        
        $languages = create(Language::class, ['creator_id' => $this->admin->id], 3);

        // When We Hit The Language Read Endpoint
        $response = $this->getJson(route('dashboard.languages.index'));
        
        // Then It Should Get The "3" Languages That Was Created
        $response->assertOk();
        $response->assertSee($languages->first()->en_name);
        $response->assertSee($languages->get(1)->en_name);
        $response->assertSee($languages->last()->en_name);
    }

    /** @test */
    public function authenticate_companies_can_read_their_single_language()
    {
        // Given We Have An Authenticated Company
        $this->signIn($this->company);
        
        // When We Hit The Language Read Endpoint
        $response = $this->getJson($this->companyLanguage->path());
        
        // Then It Should Get The Language That Was Created
        $response->assertOk();
        $this->assertEquals($this->companyLanguage->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_companies_can_read_all_their_language()
    {
        // Given We Have An Authenticated Company
        $this->signIn($this->company);
        
        $languages = create(Language::class, ['creator_id' => $this->company->id], 3);

        // When We Hit The Language Read Endpoint
        $response = $this->getJson(route('dashboard.languages.index'));
        
        // Then It Should Get The "3" Languages That Was Created
        $response->assertOk();
        $response->assertSee($languages->first()->en_name);
        $response->assertSee($languages->get(1)->en_name);
        $response->assertSee($languages->last()->en_name);
    }

    protected function readLanguage($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin Or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The Language Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Language Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}