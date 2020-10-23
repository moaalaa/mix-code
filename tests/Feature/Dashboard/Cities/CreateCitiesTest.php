<?php

namespace Tests\Feature\Dashboard\Cities;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\City;
use MixCode\Country;

class CreateCitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_create_new_city()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The City Store Endpoint
        $response = $this->postJson(route('dashboard.cities.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The City Store Endpoint
        $response = $this->postJson(route('dashboard.cities.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_create_new_city()
    { 
        // Given We Have An Admin And City
        $this->signInAsAdmin();
        
        $city = make(City::class);
        
        // When We Hit The City Store Endpoint
        $this->postJson(route('dashboard.cities.store'), $city->toArray());
        
        // Then Cities Count Should Be 1
        $this->assertEquals(1, City::count());
    }

    /** @test */
    public function city_required_a_valid_en_name()
    {
        $this->createNewCity(['en_name' => null])->assertSessionHasErrors('en_name');
    }
    
    /** @test */
    public function city_required_a_valid_ar_name()
    {
        $this->createNewCity(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }
    
    /** @test */
    public function city_require_a_valid_and_exists_country()
    {
        $this->createNewCity(['country_id' => 'not-valid-country'])->assertSessionHasErrors('country_id');
        $this->createNewCity(['country_id' => null])->assertSessionHasErrors('country_id');
        $this->createNewCity(['country_id' => create(Country::class)->id])->assertSessionHasNoErrors('country_id');
    }
    
    /** @test */
    public function city_require_a_valid_status()
    {
        $this->createNewCity(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->createNewCity(['status' => null])->assertSessionHasErrors('status');
        $this->createNewCity(['status' => City::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->createNewCity(['status' => City::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }
 
    /** @test */
    public function city_may_accept_a_valid_image()
    {
        $this->createNewCity(['image' => 'not-valid-media-file'])->assertSessionHasErrors('image');
    }
    
    protected function createNewCity($overrides)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And City
        $this->signInAsAdmin();
 
        $city = make(City::class, $overrides);
    
        // When We Hit The City Store Endpoint
        return $this->post(route('dashboard.cities.store'), $city->toArray());
    }
}