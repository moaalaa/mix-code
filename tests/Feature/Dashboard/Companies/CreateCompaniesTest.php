<?php

namespace Tests\Company\Dashboard\Companies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Company;
use MixCode\User;

class CreateCompaniesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_create_new_company()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));
        
        // When We Hit The company Store Endpoint
        $response = $this->postJson(route('dashboard.companys.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The company Store Endpoint
        $response = $this->postJson(route('dashboard.companys.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_create_new_company()
    { 
        // Given We Have An Admin And company
        $this->signInAsAdmin();
        
        $company = make(Company::class);
        
        // When We Hit The company Store Endpoint
        $this->postJson(route('dashboard.companys.store'), $company->toArray());
        
        // Then companys Count Should Be 1
        $this->assertEquals(1, Company::count());
    }

    /** @test */
    public function authenticate_companies_can_create_new_company()
    { 
        // Given We Have An Admin And company
        $this->signIn(create(User::class, ['type' => User::COMPANY_TYPE]));
        
        $company = make(Company::class);
        
        // When We Hit The company Store Endpoint
        $this->postJson(route('dashboard.companys.store'), $company->toArray());
        
        // Then companys Count Should Be 1
        $this->assertEquals(1, Company::count());
    }

    /** @test */
    public function company_required_a_valid_en_name()
    {
        $this->createNewCompany(['en_name' => null])->assertSessionHasErrors('en_name');
    }
    
    /** @test */
    public function company_required_a_valid_ar_name()
    {
        $this->createNewCompany(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }
        
    protected function createNewCompany($overrides)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And company
        $this->signInAsAdmin();
 
        $company = make(Company::class, $overrides);
    
        // When We Hit The company Store Endpoint
        return $this->post(route('dashboard.companys.store'), $company->toArray());
    }
}