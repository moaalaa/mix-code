<?php

namespace Tests\Category\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Category;
use MixCode\Trip;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;
 
    /** @test */
    public function it_can_read_single_category()
    {
        // Given We Have A Category        
        $category = create(Category::class);
        
        // When We Hit The Category Read Endpoint
        $response = $this->getJson($category->apiPath());
        
        // Then It Should Get The Category That Was Created
        $response->assertOk();
        $this->assertContains($category->en_name, $response->json());
    }

    /** @test */
    public function it_can_read_all_categories()
    {
        // Given We Have "3" Categories
        $categories = create(Category::class, [], 3);

        // When We Hit The Category Read Endpoint
        $response = $this->getJson(route('api.categories.index'));
        
        // Then It Should Get The "3" Categories That Was Created
        $response->assertOk();
        $response->assertSee($categories->first()->name);
        $response->assertSee($categories->get(1)->name);
        $response->assertSee($categories->last()->name);
    }

    /** @test */
    public function it_can_read_all_its_trips()
    {
        // Given We Have a Category and trip belongs to it        
        $category = create(Category::class);
        $trip = create(Trip::class);
        $trip->categories()->attach($category->id);

        // When We Hit The Category Read Endpoint
        $response = $this->getJson(route('api.categories.show.trips', $category));
        
        // Then It Should Get The Category Trips
        $response->assertOk();
        $response->assertSee($trip->en_name);
    }
}