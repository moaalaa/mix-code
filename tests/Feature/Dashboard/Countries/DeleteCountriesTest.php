<?php

namespace Tests\Feature\Dashboard\Countries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Country;

class DeleteCountriesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->country = create(Country::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_delete_existing_country()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The Country Delete Endpoint
        $response = $this->deleteJson(route('dashboard.countries.destroy', $this->country));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Country Delete Endpoint
        $response = $this->deleteJson(route('dashboard.countries.destroy', $this->country));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_country()
    { 
        // Given We Have An Admin And Country
        $this->signInAsAdmin();
        
        // When We Hit The Country Delete Endpoint
        $response = $this->deleteJson(route('dashboard.countries.destroy', $this->country));
                
        // Then it Should Redirect to the country index page after delete the country
        $response->assertRedirect(route('dashboard.countries.index'));
        $this->assertDatabaseMissing('countries', $this->country->toArray());
        $this->assertEquals(0, Country::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_existing_country()
    { 
        // Given We Have An Admin And Deleted Country
        $this->signInAsAdmin();

        $this->country->delete();

        // When We Hit The Country Delete Endpoint
        $response = $this->patchJson(route('dashboard.countries.restore', $this->country));
                
        // Then it Should Redirect to the country trashed index page after delete the country
        $response->assertRedirect(route('dashboard.countries.trashed'));
        $this->assertEquals(1, Country::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_country_forever()
    { 
        // Given We Have An Admin And Deleted Country
        $this->signInAsAdmin();
        
        $this->country->delete();
        
        // When We Hit The Country Delete Endpoint
        $response = $this->deleteJson(route('dashboard.countries.force_delete', $this->country));
        
        // Then it Should Redirect to the country trashed index page after delete the country
        $response->assertRedirect(route('dashboard.countries.trashed'));
        $this->assertEquals(0, Country::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_administrators_can_multi_delete_existing_countries()
    { 
        // Given We Have An Admin And Countries
        $this->signInAsAdmin();
        $ids = create(Country::class, [], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->country->id]);
        
        // When We Hit The Country multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.countries.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the country index page after delete the country
        $response->assertRedirect(route('dashboard.countries.index'));
        $this->assertDatabaseMissing('countries', $ids);
        $this->assertEquals(0, Country::count());
    }
}