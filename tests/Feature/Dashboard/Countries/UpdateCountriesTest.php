<?php

namespace Tests\Feature\Dashboard\Countries;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Country;

class UpdateCountriesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->country = create(Country::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_update_existing_country()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The Country Update Endpoint
        $response = $this->patchJson(route('dashboard.countries.update', $this->country));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Country Update Endpoint
        $response = $this->patchJson(route('dashboard.countries.update', $this->country));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_existing_country()
    {
        // Given We Have An Admin And Country
        $this->signInAsAdmin();
        
        // Set Country Name
        $updated_data = ['en_name' => 'Updated Country Name'];
        $data = array_merge($this->country->toArray(),  $updated_data);

        // When We Hit The Country Update Endpoint
        $response = $this->patchJson(route('dashboard.countries.update', $this->country), $data);

        // Then it Should Redirect to the country show page And The Country name Should Be Updated
        $response->assertRedirect($this->country->path());

        $this->assertEquals($updated_data, ['en_name' => $this->country->fresh()->en_name]);
    }

    /** @test */
    public function country_required_a_valid_en_name()
    {
        $this->updateCountry(['en_name' => null])->assertSessionHasErrors('en_name');
    }

    /** @test */
    public function country_required_a_valid_ar_name()
    {
        $this->updateCountry(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }

    /** @test */
    public function country_require_a_valid_status()
    {
        $this->updateCountry(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->updateCountry(['status' => null])->assertSessionHasErrors('status');
        $this->updateCountry(['status' => Country::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->updateCountry(['status' => Country::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }

    /** @test */
    public function country_may_accept_a_valid_image()
    {
        $this->updateCountry(['image' => 'not-valid-media-file'])->assertSessionHasErrors('image');
    }

    protected function updateCountry($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Country
        $this->signInAsAdmin();

        $data = array_merge($this->country->toArray(), $data);

        // When We Hit The Country Update Endpoint
        return $this->patch(route('dashboard.countries.update', $this->country), $data);
    }
}
