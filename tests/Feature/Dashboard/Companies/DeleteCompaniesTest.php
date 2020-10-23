<?php

namespace Tests\Company\Dashboard\Companies;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Company;
use MixCode\User;

class DeleteCompaniesTest extends TestCase
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
    public function non_authenticate_administrators_or_companies_cant_delete_existing_company()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin Or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));
        
        // When We Hit The Feature Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.destroy', $this->company));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Feature Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.destroy', $this->company));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_delete_their_existing_company()
    { 
        // Given We Have An Admin And Feature
        $this->signInAsAdmin($this->admin);
        
        // When We Hit The Feature Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.destroy', $this->adminCompany));
                
        // Then it Should Redirect to the feature index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.index'));
        $this->assertDatabaseMissing('companies', $this->adminCompany->toArray());
        $this->assertEquals(2, Company::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_their_existing_company()
    { 
        // Given We Have An Admin And Deleted Feature
        $this->signInAsAdmin($this->admin);

        $this->adminCompany->delete();

        // When We Hit The Feature Delete Endpoint
        $response = $this->patchJson(route('dashboard.companies.restore', $this->adminCompany));
                
        // Then it Should Redirect to the feature trashed index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.trashed'));
        $this->assertEquals(3, Company::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_their_existing_company_forever()
    { 
        // Given We Have An Admin And Deleted Feature
        $this->signInAsAdmin($this->admin);
        
        $this->adminCompany->delete();
        
        // When We Hit The Feature Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.force_delete', $this->adminCompany));
        
        // Then it Should Redirect to the feature trashed index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.trashed'));
        $this->assertEquals(2, Company::withTrashed()->count());
    }    

    /** @test */
    public function authenticate_administrators_can_multi_delete_their_existing_companies()
    { 
        // Given We Have An Admin And Companies
        $this->signInAsAdmin($this->admin);
        $ids = create(Company::class, ['creator_id' => $this->admin->id], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->adminCompany->id]);
        
        // When We Hit The Feature multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the feature index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.index'));
        $this->assertDatabaseMissing('companies', $ids);
        $this->assertEquals(2, Company::count());
    }

    /** @test */
    public function authenticate_companies_can_delete_their_existing_company()
    { 
        // Given We Have a Company And Feature
        $this->signIn($this->company);
        
        // When We Hit The Feature Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.destroy', $this->companyFeature));
                
        // Then it Should Redirect to the feature index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.index'));
        $this->assertDatabaseMissing('companies', $this->companyFeature->toArray());
        $this->assertEquals(2, Company::count());
    }

    /** @test */
    public function authenticate_companies_can_restore_their_existing_company()
    { 
        // Given We Have a Company And Deleted Feature
        $this->signIn($this->company);

        $this->companyFeature->delete();

        // When We Hit The Feature Delete Endpoint
        $response = $this->patchJson(route('dashboard.companies.restore', $this->companyFeature));
                
        // Then it Should Redirect to the feature trashed index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.trashed'));
        $this->assertEquals(3, Company::count());
    }

    /** @test */
    public function authenticate_companies_can_delete_their_existing_company_forever()
    { 
        // Given We Have a Company And Deleted Feature
        $this->signIn($this->company);
        
        $this->companyFeature->delete();
        
        // When We Hit The Feature Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.force_delete', $this->companyFeature));
        
        // Then it Should Redirect to the feature trashed index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.trashed'));
        $this->assertEquals(2, Company::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_companies_can_multi_delete_their_existing_companies()
    { 
        // Given We Have a Company And Companies
        $this->signIn($this->company);
        $ids = create(Company::class, ['creator_id' => $this->company->id], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->companyFeature->id]);
        
        // When We Hit The Feature multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.companies.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the feature index page after delete the feature
        $response->assertRedirect(route('dashboard.companies.index'));
        $this->assertDatabaseMissing('companies', $ids);
        $this->assertEquals(2, Company::count());
    }
}