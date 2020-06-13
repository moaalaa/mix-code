<?php

namespace Tests\Feature\Dashboard\Languages;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Language;
use MixCode\User;

class DeleteLanguagesTest extends TestCase
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
    public function non_authenticate_administrators_or_companies_cant_delete_existing_language()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));
        
        // When We Hit The Language Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.destroy', $this->language));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Language Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.destroy', $this->language));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_delete_their_existing_language()
    { 
        // Given We Have An Admin And Language
        $this->signInAsAdmin($this->admin);
        
        // When We Hit The Language Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.destroy', $this->adminLanguage));
                
        // Then it Should Redirect to the language index page after delete the language
        $response->assertRedirect(route('dashboard.languages.index'));
        $this->assertDatabaseMissing('languages', $this->adminLanguage->toArray());
        $this->assertEquals(2, Language::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_their_existing_language()
    { 
        // Given We Have An Admin And Deleted Language
        $this->signInAsAdmin($this->admin);

        $this->adminLanguage->delete();

        // When We Hit The Language Delete Endpoint
        $response = $this->patchJson(route('dashboard.languages.restore', $this->adminLanguage));
                
        // Then it Should Redirect to the language trashed index page after delete the language
        $response->assertRedirect(route('dashboard.languages.trashed'));
        $this->assertEquals(3, Language::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_their_existing_language_forever()
    { 
        // Given We Have An Admin And Deleted Language
        $this->signInAsAdmin($this->admin);
        
        $this->adminLanguage->delete();
        
        // When We Hit The Language Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.force_delete', $this->adminLanguage));
        
        // Then it Should Redirect to the language trashed index page after delete the language
        $response->assertRedirect(route('dashboard.languages.trashed'));
        $this->assertEquals(2, Language::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_administrators_can_multi_delete_their_existing_languages()
    { 
        // Given We Have An Admin And Languages
        $this->signInAsAdmin($this->admin);
        $ids = create(Language::class, ['creator_id' => $this->admin->id], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->adminLanguage->id]);
        
        // When We Hit The Language multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the language index page after delete the language
        $response->assertRedirect(route('dashboard.languages.index'));
        $this->assertDatabaseMissing('languages', $ids);
        $this->assertEquals(2, Language::count());
    }

    /** @test */
    public function authenticate_companies_can_delete_their_existing_language()
    { 
        // Given We Have A Company And Language
        $this->signIn($this->company);
        
        // When We Hit The Language Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.destroy', $this->companyLanguage));
                
        // Then it Should Redirect to the language index page after delete the language
        $response->assertRedirect(route('dashboard.languages.index'));
        $this->assertDatabaseMissing('languages', $this->companyLanguage->toArray());
        $this->assertEquals(2, Language::count());
    }

    /** @test */
    public function authenticate_companies_can_restore_their_existing_language()
    { 
        // Given We Have A Company And Deleted Language
        $this->signIn($this->company);

        $this->companyLanguage->delete();

        // When We Hit The Language Delete Endpoint
        $response = $this->patchJson(route('dashboard.languages.restore', $this->companyLanguage));
                
        // Then it Should Redirect to the language trashed index page after delete the language
        $response->assertRedirect(route('dashboard.languages.trashed'));
        $this->assertEquals(3, Language::count());
    }

    /** @test */
    public function authenticate_companies_can_delete_their_existing_language_forever()
    { 
        // Given We Have A Company And Deleted Language
        $this->signIn($this->company);
        
        $this->companyLanguage->delete();
        
        // When We Hit The Language Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.force_delete', $this->companyLanguage));
        
        // Then it Should Redirect to the language trashed index page after delete the language
        $response->assertRedirect(route('dashboard.languages.trashed'));
        $this->assertEquals(2, Language::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_companies_can_multi_delete_their_existing_languages()
    { 
        // Given We Have A Company And Languages
        $this->signIn($this->company);
        $ids = create(Language::class, ['creator_id' => $this->company->id], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->companyLanguage->id]);
        
        // When We Hit The Language multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.languages.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the language index page after delete the language
        $response->assertRedirect(route('dashboard.languages.index'));
        $this->assertDatabaseMissing('languages', $ids);
        $this->assertEquals(2, Language::count());
    }
}