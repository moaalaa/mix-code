<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Country;
use MixCode\Trip;

class CountryApiTest extends TestCase
{
    use RefreshDatabase;
 
    /** @test */
    public function it_can_read_single_country()
    {
        // Given We Have A Country        
        $country = create(Country::class);
        
        // When We Hit The Country Read Endpoint
        $response = $this->getJson($country->apiPath());
        
        // Then It Should Get The Country That Was Created
        $response->assertOk();
        $this->assertContains($country->en_name, $response->json());
    }

    /** @test */
    public function it_can_read_all_country()
    {
        // Given We Have "3" Countries        
        $countries = create(Country::class, [], 3);

        // When We Hit The Country Read Endpoint
        $response = $this->getJson(route('api.countries.index'));
        
        // Then It Should Get The "3" Countries That Was Created
        $response->assertOk();
        $response->assertSee($countries->first()->name);
        $response->assertSee($countries->get(1)->name);
        $response->assertSee($countries->last()->name);
    }

    /** @test */
    public function it_can_read_all_its_trips()
    {
        // Given We Have a Country and trip belongs to it
        $country = create(Country::class);
        $trip = create(Trip::class, ['country_id' => $country->id]);

        // When We Hit The Country Read Endpoint
        $response = $this->getJson(route('api.countries.show.trips', $country));
        
        // Then It Should Get The Country Trips
        $response->assertOk();
        $response->assertSee($trip->en_name);
    }
}