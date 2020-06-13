<?php

namespace Tests\Feature\Dashboard\Countries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Country;

class ReadCountriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_read_single_country()
    {
        $this->readCountry(create(Country::class)->path());
    }

    /** @test */
    public function non_authenticate_administrators_cant_read_all_country()
    {
        $this->readCountry(route('dashboard.countries.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_single_country()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $country = create(Country::class);

        // When We Hit The Country Read Endpoint
        $response = $this->getJson($country->path());
        
        // Then It Should Get The Country That Was Created
        $response->assertOk();
        $this->assertEquals($country->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_all_country()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $countries = create(Country::class, [], 3);

        // When We Hit The Country Read Endpoint
        $response = $this->getJson(route('dashboard.countries.index'));
        
        // Then It Should Get The "3" Countries That Was Created
        $response->assertOk();
        $response->assertSee($countries->first()->en_name);
        $response->assertSee($countries->get(1)->en_name);
        $response->assertSee($countries->last()->en_name);
    }

    protected function readCountry($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The Country Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Country Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}