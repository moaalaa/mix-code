<?php

namespace Tests\Company\Dashboard\Companies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Company;
use MixCode\User;

class UpdateCompaniesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = create(User::class, ['type' => User::ADMIN_TYPE]);
        $this->adminCompany = create(Company::class, ['creator_id' => $this->admin->id]);
        
        $this->company = create(User::class, ['type' => User::COMPANY_TYPE]);
        $this->companyFeature = create(Company::class, ['creator_id' => $this->company->id]);

        $this->company = create(Company::class);
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_update_existing_company()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The Feature Update Endpoint
        $response = $this->patchJson(route('dashboard.companies.update', $this->company));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Feature Update Endpoint
        $response = $this->patchJson(route('dashboard.companies.update', $this->company));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_their_existing_company()
    {
        // Given We Have An Admin And Feature
        $this->signInAsAdmin($this->admin);
        
        // Set Feature Name
        $updated_data = ['en_name' => 'Updated Company Name'];
        $data = array_merge($this->adminCompany->toArray(),  $updated_data);

        // When We Hit The Feature Update Endpoint
        $response = $this->patchJson(route('dashboard.companies.update', $this->adminCompany), $data);

        // Then it Should Redirect to the feature show page And The Feature name Should Be Updated
        $response->assertRedirect($this->adminCompany->path());

        $this->assertEquals($updated_data, ['en_name' => $this->adminCompany->fresh()->en_name]);
    }

    /** @test */
    public function authenticate_companies_can_update_their_existing_company()
    {
        // Given We Have A Company And Feature
        $this->signIn($this->company);
        
        // Set Feature Name
        $updated_data = ['en_name' => 'Updated Company Name'];
        $data = array_merge($this->companyFeature->toArray(),  $updated_data);

        // When We Hit The Feature Update Endpoint
        $response = $this->patchJson(route('dashboard.companies.update', $this->companyFeature), $data);

        // Then it Should Redirect to the feature show page And The Feature name Should Be Updated
        $response->assertRedirect($this->companyFeature->path());

        $this->assertEquals($updated_data, ['en_name' => $this->companyFeature->fresh()->en_name]);
    }

    /** @test */
    public function company_required_a_valid_en_name()
    {
        $this->updateCompany(['en_name' => null])->assertSessionHasErrors('en_name');
    }

    /** @test */
    public function company_required_a_valid_ar_name()
    {
        $this->updateCompany(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }

    protected function updateCompany($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Feature
        $this->signInAsAdmin($this->admin);

        $data = array_merge($this->adminCompany->toArray(), $data);

        // When We Hit The Feature Update Endpoint
        return $this->patch(route('dashboard.companies.update', $this->adminCompany), $data);
    }
}
