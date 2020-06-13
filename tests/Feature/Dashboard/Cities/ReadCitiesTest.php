<?php

namespace Tests\Feature\Dashboard\Cities;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\City;

class ReadCitiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_read_single_city()
    {
        $this->readCity(create(City::class)->path());
    }

    /** @test */
    public function non_authenticate_administrators_cant_read_all_city()
    {
        $this->readCity(route('dashboard.cities.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_single_city()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $city = create(City::class);

        // When We Hit The City Read Endpoint
        $response = $this->getJson($city->path());
        
        // Then It Should Get The City That Was Created
        $response->assertOk();
        $this->assertEquals($city->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_all_city()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $cities = create(City::class, [], 3);

        // When We Hit The City Read Endpoint
        $response = $this->getJson(route('dashboard.cities.index'));
        
        // Then It Should Get The "3" Cities That Was Created
        $response->assertOk();
        $response->assertSee($cities->first()->en_name);
        $response->assertSee($cities->get(1)->en_name);
        $response->assertSee($cities->last()->en_name);
    }

    protected function readCity($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The City Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The City Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}