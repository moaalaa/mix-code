<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Trip;

class FavoritesApiTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->trip = create(Trip::class);
    }

    /** @test */
    public function it_can_mark_trips_as_favorite()
    {
        $this->apiSignIn();
        
        // Given We Have Trip
        // When We Hit The Mark Trip As Favorite Endpoint
        $this->postJson(route('api.trips.favorite.mark', $this->trip))
            ->assertStatus(Response::HTTP_CREATED);
            
        // Then Trip Should Be Favorite Successfully
        $this->assertTrue($this->trip->isFavorited());
        $this->assertCount(1, $this->trip->favorites);
    }
 
    /** @test */
    public function it_can_mark_trips_as_un_favorite()
    {
        $this->apiSignIn();
        
        // Given We Have Trip
        // When We Hit The Mark Trip As Un Favorite Endpoint
        $this->deleteJson(route('api.trips.favorite.un_mark', $this->trip))
            ->assertOk();
            
        // Then Trip Should Be Un Favorite Successfully
        $this->assertFalse($this->trip->isFavorited());
        $this->assertCount(0, $this->trip->favorites);
    }
    
    /** @test */
    public function it_can_favorite_trips_once()
    {        
        $this->apiSignIn();

        
        // Given We Have Trip
        // When We Hit The Mark Trip As Favorite Endpoint 2 Times
        $this->postJson(route('api.trips.favorite.mark', $this->trip))->assertStatus(Response::HTTP_CREATED);
            
        $this->postJson(route('api.trips.favorite.mark', $this->trip));
        
        // Then we will have only one favorite "resource"
        //  and others favorites operations will be ignored
        $this->assertCount(1, $this->trip->favorites);
    }

    /** @test */
    public function it_list_all_favorite_trips()
    {
        $this->apiSignIn();
        
        // Given We Have 2 Favorited Trip
        $tripOne = $this->trip;
        $tripTwo = create(Trip::class);

        $tripOne->markAsFavorite();
        $tripTwo->markAsFavorite();
        
        // When We Hit The Get All Favorite Trips Endpoint
        $response = $this->getJson(route('api.trips.favorite'))->assertStatus(Response::HTTP_OK);

        // Then Favorited Trips Should Be Returned
        $response->assertSee($tripOne->en_name);
        $response->assertSee($tripTwo->en_name);
    }
}