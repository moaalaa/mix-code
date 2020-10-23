<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MixCode\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');
    }

    /** @test */
    public function guest_customer_can_create_new_account()
    {
        // Given we have a customer
        $customer     = make(User::class, ['type' => User::CUSTOMER_TYPE, 'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        
        // When We hit register endpoint
        $this->post(route('register'), $customer->makeVisible(['password'])->toArray());

        // Then We Should See the customer saved in Database
        $this->assertEquals(1, User::count());
        $this->assertTrue($customer->isCustomer());
        $this->assertDatabaseHas('users', ['username' => $customer->username]);
    }
    
    /** @test */
    public function guest_company_can_create_new_account()
    {
        // Given we have a Company
        $company    = make(User::class, ['type' => User::COMPANY_TYPE, 'password_confirmation' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi']);
        $media = [
            'id_card'               => UploadedFile::fake()->create('id_card.pdf'),
            'travel_certificate'    => UploadedFile::fake()->create('travel_certificate.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card.pdf'),
            'business_register'     => UploadedFile::fake()->create('business_register.pdf'),
            'logo'                  => UploadedFile::fake()->create('logo.png'),
        ];
        
        $data = array_merge($company->makeVisible(['password'])->toArray(), $media);


        // When We hit register endpoint
        $this->post(route('register'), $data);
        
        // Then We Should See the company saved in Database
        $this->assertEquals(1, User::count());
        $this->assertTrue($company->isCompany());
        $this->assertDatabaseHas('users', ['username' => $company->username]);
    }
}