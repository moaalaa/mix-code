<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Review;
use MixCode\Trip;

class ReviewsApiTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->trip = create(Trip::class);
    }
 
    /** @test */
    public function trip_can_submit_new_review()
    {
        // Given We Have Trip and Review
        // When We Hit The Trip Submit Review Endpoint
        $this->postJson(route('api.trips.reviews.submit', $this->trip), create(Review::class)->toArray())
            ->assertStatus(Response::HTTP_CREATED);
    } 
}