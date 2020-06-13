<?php

namespace Tests\Company\Dashboard\Companies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Company;
use MixCode\User;

class ReadCompaniesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = create(User::class, ['type' => User::ADMIN_TYPE]);
        $this->adminCompany = create(Company::class, ['creator_id' => $this->admin->id]);
        
        $this->company = create(User::class, ['type' => User::COMPANY_TYPE]);
        $this->companyFeature = create(Company::class, ['creator_id' => $this->company->id]);
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_read_single_company()
    {
        $this->readCompany(create(Company::class)->path());
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_read_all_company()
    {
        $this->readCompany(route('dashboard.companies.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_only_their_single_company()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin($this->admin);

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson($this->adminCompany->path());
        
        // Then It Should Get The Feature That Was Created
        $response->assertOk();
        $this->assertEquals($this->adminCompany->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_only_all_their_company()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin($this->admin);
        
        $companies = create(Company::class, ['creator_id' => $this->admin->id], 3);

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson(route('dashboard.companies.index'));
        
        // Then It Should Get The "3" Features That Was Created
        $response->assertOk();
        $response->assertSee($companies->first()->en_name);
        $response->assertSee($companies->get(1)->en_name);
        $response->assertSee($companies->last()->en_name);
    }

    /** @test */
    public function authenticate_companies_can_read_only_their_single_company()
    {
        // Given We Have An Authenticated Company
        $this->signIn($this->company);

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson($this->companyFeature->path());
        
        // Then It Should Get The Feature That Was Created
        $response->assertOk();
        $this->assertEquals($this->companyFeature->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_companies_can_read_only_all_their_company()
    {
        // Given We Have An Authenticated Company
        $this->signIn($this->company);
        
        $companies = create(Company::class, ['creator_id' => $this->company->id], 3);

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson(route('dashboard.companies.index'));
        
        // Then It Should Get The "3" Features That Was Created
        $response->assertOk();
        $response->assertSee($companies->first()->en_name);
        $response->assertSee($companies->get(1)->en_name);
        $response->assertSee($companies->last()->en_name);
    }

    protected function readCompany($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}