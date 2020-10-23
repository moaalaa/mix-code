<?php

namespace Tests\Feature\Dashboard\Countries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Country;

class CreateCountriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_create_new_country()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The Country Store Endpoint
        $response = $this->postJson(route('dashboard.countries.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Country Store Endpoint
        $response = $this->postJson(route('dashboard.countries.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_create_new_country()
    { 
        // Given We Have An Admin And Country
        $this->signInAsAdmin();
        
        $country = make(Country::class);
        
        // When We Hit The Country Store Endpoint
        $this->postJson(route('dashboard.countries.store'), $country->toArray());
        
        // Then Countries Count Should Be 1
        $this->assertEquals(1, Country::count());
    }

    /** @test */
    public function country_required_a_valid_en_name()
    {
        $this->createNewCountry(['en_name' => null])->assertSessionHasErrors('en_name');
    }
    
    /** @test */
    public function country_required_a_valid_ar_name()
    {
        $this->createNewCountry(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }
    
    /** @test */
    public function country_require_a_valid_status()
    {
        $this->createNewCountry(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->createNewCountry(['status' => null])->assertSessionHasErrors('status');
        $this->createNewCountry(['status' => Country::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->createNewCountry(['status' => Country::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }
 
    /** @test */
    public function country_may_accept_a_valid_image()
    {
        $this->createNewCountry(['image' => 'not-valid-media-file'])->assertSessionHasErrors('image');
    }

    protected function createNewCountry($overrides)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Country
        $this->signInAsAdmin();
 
        $country = make(Country::class, $overrides);
    
        // When We Hit The Country Store Endpoint
        return $this->post(route('dashboard.countries.store'), $country->toArray());
    }
}