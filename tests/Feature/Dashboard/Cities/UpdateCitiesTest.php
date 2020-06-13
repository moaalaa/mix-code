<?php

namespace Tests\Feature\Dashboard\Cities;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\City;
use MixCode\Country;

class UpdateCitiesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->city = create(City::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_update_existing_city()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The City Update Endpoint
        $response = $this->patchJson(route('dashboard.cities.update', $this->city));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The City Update Endpoint
        $response = $this->patchJson(route('dashboard.cities.update', $this->city));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_existing_city()
    {
        // Given We Have An Admin And City
        $this->signInAsAdmin();
        
        // Set City Name
        $updated_data = ['en_name' => 'Updated City Name'];
        $data = array_merge($this->city->toArray(),  $updated_data);

        // When We Hit The City Update Endpoint
        $response = $this->patchJson(route('dashboard.cities.update', $this->city), $data);

        // Then it Should Redirect to the city show page And The City name Should Be Updated
        $response->assertRedirect($this->city->path());

        $this->assertEquals($updated_data, ['en_name' => $this->city->fresh()->en_name]);
    }

    /** @test */
    public function city_required_a_valid_en_name()
    {
        $this->updateCity(['en_name' => null])->assertSessionHasErrors('en_name');
    }

    /** @test */
    public function city_required_a_valid_ar_name()
    {
        $this->updateCity(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }

    /** @test */
    public function city_require_a_valid_status()
    {
        $this->updateCity(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->updateCity(['status' => null])->assertSessionHasErrors('status');
        $this->updateCity(['status' => City::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->updateCity(['status' => City::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }

    /** @test */
    public function city_require_a_valid_and_exists_country()
    {
        $this->updateCity(['country_id' => 'not-valid-country'])->assertSessionHasErrors('country_id');
        $this->updateCity(['country_id' => null])->assertSessionHasErrors('country_id');
        $this->updateCity(['country_id' => create(Country::class)->id])->assertSessionHasNoErrors('country_id');
    }
    
    /** @test */
    public function city_may_accept_a_valid_image()
    {
        $this->updateCity(['image' => 'not-valid-media-file'])->assertSessionHasErrors('image');
    }

    protected function updateCity($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And City
        $this->signInAsAdmin();

        $data = array_merge($this->city->toArray(), $data);

        // When We Hit The City Update Endpoint
        return $this->patch(route('dashboard.cities.update', $this->city), $data);
    }
}
