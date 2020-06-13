<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use MixCode\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = create(User::class);
    }

    /** @test */
    public function it_have_many_countries()
    {
        $this->assertInstanceOf(Collection::class, $this->user->countries);
    }

    /** @test */
    public function it_have_many_cities()
    {
        $this->assertInstanceOf(Collection::class, $this->user->cities);
    }

    /** @test */
    public function it_have_many_categories()
    {
        $this->assertInstanceOf(Collection::class, $this->user->categories);
    }

    /** @test */
    public function it_have_many_features()
    {
        $this->assertInstanceOf(Collection::class, $this->user->features);
    }

    /** @test */
    public function it_have_many_languages()
    {
        $this->assertInstanceOf(Collection::class, $this->user->languages);
    }

    /** @test */
    public function it_have_many_cards()
    {
        $this->assertInstanceOf(Collection::class, $this->user->cards);
    }

    /** @test */
    public function it_can_determine_if_the_user_is_admin_or_company_or_customer()
    {
        $customer   = create(User::class, ['type' => User::CUSTOMER_TYPE]);
        $company   = create(User::class, ['type' => User::COMPANY_TYPE]);
        $admin  = create(User::class, ['type' => User::ADMIN_TYPE]);

        // Customer Unit Tests
        $this->assertTrue($customer->isType(User::CUSTOMER_TYPE));
        $this->assertTrue($customer->isCustomer());
        $this->assertFalse($customer->isCompany());
        $this->assertFalse($customer->isAdmin());
        
        // Company Unit Tests
        $this->assertTrue($company->isType(User::COMPANY_TYPE));
        $this->assertTrue($company->isCompany());
        $this->assertFalse($company->isCustomer());
        $this->assertFalse($company->isAdmin());

        // Admin Unit Tests
        $this->assertTrue($admin->isType(User::ADMIN_TYPE));
        $this->assertTrue($admin->isAdmin());
        $this->assertFalse($admin->isCustomer());
        $this->assertFalse($admin->isCompany());
    }
    
    /** @test */
    public function it_can_determine_if_the_user_is_active_or_pending_or_disable()
    {
        $active     = create(User::class, ['status' => User::ACTIVE_STATUS]);
        $pending    = create(User::class, ['status' => User::PENDING_STATUS]);
        $disable   = create(User::class, ['status' => User::INACTIVE_STATUS]);

        // Active Unit Tests
        $this->assertTrue($active->hasStatus(User::ACTIVE_STATUS));
        $this->assertTrue($active->isActive());
        $this->assertFalse($active->isPending());
        $this->assertFalse($active->isInActive());
        
        // Pending Unit Tests
        $this->assertTrue($pending->hasStatus(User::PENDING_STATUS));
        $this->assertTrue($pending->isPending());
        $this->assertFalse($pending->isActive());
        $this->assertFalse($pending->isInActive());

        // InActive Unit Tests
        $this->assertTrue($disable->hasStatus(User::INACTIVE_STATUS));
        $this->assertTrue($disable->isInActive());
        $this->assertFalse($disable->isPending());
        $this->assertFalse($disable->isActive());
    }

    /** @test */
    public function it_can_attach_media()
    {
        $this->assertEquals(0, $this->user->media()->count());

        $this->user->attachMedia([
            'id_card'               => UploadedFile::fake()->create('id_card.pdf'),
            'travel_certificate'    => UploadedFile::fake()->create('travel_certificate.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card.pdf'),
            'business_register'     => UploadedFile::fake()->create('business_register.pdf'),
        ]);

        $this->assertEquals(4, $this->user->fresh()->media()->count());
    }
    
    /** @test */
    public function it_can_sync_media()
    {
        $this->user->attachMedia([
            'id_card'               => UploadedFile::fake()->create('id_card.pdf'),
            'travel_certificate'    => UploadedFile::fake()->create('travel_certificate.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card.pdf'),
            'business_register'     => UploadedFile::fake()->create('business_register.pdf'),
        ]);

        $this->assertEquals(4, $this->user->media()->count());
        
        $old_id_card = $this->user->mainMediaId('id_card', 'file');
        $old_tax_card = $this->user->mainMediaId('tax_card', 'file');
        $old_travel_certificate = $this->user->mainMediaId('travel_certificate', 'file');
        $old_business_register = $this->user->mainMediaId('business_register', 'file');

        $this->user->syncMedia([
            'id_card'               => UploadedFile::fake()->create('id_card_2.pdf'),
            'tax_card'              => UploadedFile::fake()->create('tax_card_2.pdf'),
        ]);
 
        $this->assertNotEquals($old_id_card, $this->user->mainMediaId('id_card', 'file'));
        $this->assertNotEquals($old_tax_card, $this->user->mainMediaId('tax_card', 'file'));
        $this->assertEquals($old_travel_certificate, $this->user->mainMediaId('travel_certificate', 'file'));
        $this->assertEquals($old_business_register, $this->user->mainMediaId('business_register', 'file'));
    }
}