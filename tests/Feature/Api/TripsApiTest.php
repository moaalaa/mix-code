<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Review;
use MixCode\Trip;
use MixCode\TripView;

class TripsApiTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->trip = create(Trip::class);
    }

    /** @test */
    public function it_can_read_single_trip()
    {
        // Given We Have A Trip        
        // When We Hit The Trip Read Endpoint
        $response = $this->getJson($this->trip->apiPath());
        
        // Then It Should Get The Trip That Was Created 
        // and view counter should be increments by 1
        $response->assertOk();
        $this->assertContains($this->trip->en_name, $response->json());
        $this->assertEquals(1, $response->json()['payload']['views_count']);
    }

    /** @test */
    public function it_can_make_new_view_when_reding_if_user_authenticated()
    {
        // Given We Have A Trip and user not logged in        
        // When We Hit The Trip Read Endpoint
        $response = $this->getJson($this->trip->apiPath());
        
        // Then It Should Save New View And View Counter Equals One
        $response->assertOk();
        $this->assertEquals(1, $response->json()['payload']['views_count']);
        $this->assertEquals(0, TripView::count());
        
        // Given We Have A Trip and user logged in
        $this->apiSignIn();

        // When We Hit The Trip Read Endpoint
        $response = $this->getJson($this->trip->apiPath());
        
        // Then It Should Save New View And View Counter Equals One
        $response->assertOk();
        $this->assertEquals(2, $response->json()['payload']['views_count']);
        $this->assertEquals(1, TripView::count());
    }

    /** @test */
    public function it_can_read_all_trip()
    {
        // Given We Have "3" Trip        
        $trips = create(Trip::class, [], 3);

        // When We Hit The Trip Read Endpoint
        $response = $this->getJson(route('api.trips.index'));
        
        // Then It Should Get The "3" Trip That Was Created
        $response->assertOk();
        $response->assertSee($trips->first()->name);
        $response->assertSee($trips->get(1)->name);
        $response->assertSee($trips->last()->name);
    }

}