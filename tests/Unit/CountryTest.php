<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Country;
use MixCode\User;

class CountryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->country = create(Country::class);
    }

    /** @test */
    public function it_belongs_to_creator()
    {
        $this->assertInstanceOf(User::class, $this->country->creator);
    }
    
    /** @test */
    public function it_have_many_cities()
    {
        $this->assertInstanceOf(Collection::class, $this->country->cities);
    }
    
    /** @test */
    public function it_have_many_cards()
    {
        $this->assertInstanceOf(Collection::class, $this->country->cards);
    }
    
    /** @test */
    public function it_can_determine_its_dashboard_path()
    {
        $this->assertEquals(route('dashboard.countries.show', $this->country), $this->country->path());
    }
    
    /** @test */
    public function it_can_determine_if_the_country_is_active_or_disable()
    {
        $active     = create(Country::class, ['status' => Country::ACTIVE_STATUS]);
        $disable   = create(Country::class, ['status' => Country::INACTIVE_STATUS]);

        // Active Unit Tests
        $this->assertTrue($active->hasStatus(Country::ACTIVE_STATUS));
        $this->assertTrue($active->isActive());
        $this->assertFalse($active->isInActive());

        // InActive Unit Tests
        $this->assertTrue($disable->hasStatus(Country::INACTIVE_STATUS));
        $this->assertTrue($disable->isInActive());
        $this->assertFalse($disable->isActive());
    }
}