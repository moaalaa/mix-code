<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\City;
use MixCode\Country;
use MixCode\User;

class CityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->city = create(City::class);
    }

    /** @test */
    public function it_belongs_to_creator()
    {
        $this->assertInstanceOf(User::class, $this->city->creator);
    }

    /** @test */
    public function it_have_many_cards()
    {
        $this->assertInstanceOf(Collection::class, $this->city->cards);
    }

    /** @test */
    public function it_belongs_to_country()
    {
        $this->assertInstanceOf(Country::class, $this->city->country);
    }
    
    /** @test */
    public function it_can_determine_its_dashboard_path()
    {
        $this->assertEquals(route('dashboard.cities.show', $this->city), $this->city->path());
    }
    
    /** @test */
    public function it_can_determine_if_the_city_is_active_or_disable()
    {
        $active     = create(City::class, ['status' => City::ACTIVE_STATUS]);
        $disable   = create(City::class, ['status' => City::INACTIVE_STATUS]);

        // Active Unit Tests
        $this->assertTrue($active->hasStatus(City::ACTIVE_STATUS));
        $this->assertTrue($active->isActive());
        $this->assertFalse($active->isInActive());

        // InActive Unit Tests
        $this->assertTrue($disable->hasStatus(City::INACTIVE_STATUS));
        $this->assertTrue($disable->isInActive());
        $this->assertFalse($disable->isActive());
    }
}