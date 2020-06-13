<?php

namespace Tests\Feature\Site;


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Category;
use MixCode\City;
use MixCode\Country;
use MixCode\Trip;

class SearchAndFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->japan_country = create(Country::class, ['en_name' => 'Japan']);
        $this->tokyo_city = create(City::class, ['en_name' => 'Tokyo']);
        $this->kyoto_city = create(City::class, ['en_name' => 'Kyoto']);
        
        $this->safari_category = create(Category::class, ['en_name' => 'Safari']);
        $this->tour_category = create(Category::class, ['en_name' => 'tour']);
    }

    /** @test */
    public function it_can_search_by_destination()
    {
        // Given we have 4 trips , 3 of them belongs to same country and 2 of them belongs to same city
        $tokyo_trip_one = create(Trip::class, ['country_id' => $this->japan_country, 'city_id' => $this->tokyo_city])->makeVisible('en_name');
        $tokyo_trip_two = create(Trip::class, ['country_id' => $this->japan_country, 'city_id' => $this->tokyo_city])->makeVisible('en_name');
        $tokyo_trip_three = create(Trip::class, ['country_id' => $this->japan_country, 'city_id' => $this->kyoto_city])->makeVisible('en_name');
        $trip_four = create(Trip::class)->makeVisible('en_name');

        // When we hit search endpoint to search with "Japan" country
        $response = $this->getJson(route('api.trips.search', ['country' => $this->japan_country->id]));

        // Then we should see only all "Japan" related trips
        $response->assertSee($tokyo_trip_one->en_name);
        $response->assertSee($tokyo_trip_two->en_name);
        $response->assertSee($tokyo_trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);

        // When we hit search endpoint to search with "Tokyo" city
        $response = $this->getJson(route('api.trips.search', ['city' => $this->tokyo_city->id]));

        // Then we should see only all "Tokyo" related trips
        $response->assertSee($tokyo_trip_one->en_name);
        $response->assertSee($tokyo_trip_two->en_name);
        $response->assertDontSee($tokyo_trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);

        // When we hit search endpoint to search with "Japan" Country and "Kyoto" city
        $response = $this->getJson(route('api.trips.search', ['country' => $this->japan_country->id, 'city' => $this->kyoto_city->id]));

        // Then we should see only all "Japan" Country and "Kyoto" city related trips
        $response->assertDontSee($tokyo_trip_one->en_name);
        $response->assertDontSee($tokyo_trip_two->en_name);
        $response->assertSee($tokyo_trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);
    }
    
    /** @test */
    public function it_can_search_by_date()
    {
        // Given we have 4 trips, 2 of them have date to take off this week
        $trip_one = create(Trip::class, [
            'date_from' => today()->startOfWeek()->toDateString(), 
            'date_to' => today()->endOfWeek()->toDateString()
        ])->makeVisible('en_name');
        
        $trip_two = create(Trip::class, [
            'date_from' => today()->startOfWeek()->toDateString(), 
            'date_to' => today()->endOfWeek()->toDateString()
        ])->makeVisible('en_name');

        $trip_three = create(Trip::class, [
            'date_from' => today()->addWeek()->startOfWeek()->toDateString(), 
            'date_to' => today()->addWeek()->endOfWeek()->toDateString()
        ])->makeVisible('en_name');
        
        $trip_four = create(Trip::class, [
            'date_from' => today()->subWeek()->startOfWeek()->toDateString(), 
            'date_to' => today()->subWeek()->endOfWeek()->toDateString()
        ])->makeVisible('en_name');
    
        // When we hit search endpoint to search with "date_from"
        $search_date = today()->startOfWeek()->toDateString();
        $response = $this->getJson(route('api.trips.search', ['date_from' => $search_date]));

        // Then we should see only all trips After Or Equal "$search_date"
        $response->assertSee($trip_one->en_name);
        $response->assertSee($trip_two->en_name);
        $response->assertSee($trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);
        
        // When we hit search endpoint to search with "date_to"
        $search_date = today()->endOfWeek()->toDateString();
        $response = $this->getJson(route('api.trips.search', ['date_to' => $search_date]));

        // Then we should see only all trips Before Or Equal "$search_date"
        $response->assertSee($trip_one->en_name);
        $response->assertSee($trip_two->en_name);
        $response->assertDontSee($trip_three->en_name);
        $response->assertSee($trip_four->en_name);

        // When we hit search endpoint to search with "date_from" and "date_to"
        $search_start_date = today()->startOfWeek()->toDateString();
        $search_end_date = today()->endOfWeek()->toDateString();
        $response = $this->getJson(route('api.trips.search', ['date_from' => $search_start_date, 'date_to' => $search_end_date]));

        // Then we should see only all trips between "$search_start_date" and "$search_end_date"
        $response->assertSee($trip_one->en_name);
        $response->assertSee($trip_two->en_name);
        $response->assertDontSee($trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);

    }
    
    /** @test */
    public function it_can_filter_by_price_range()
    {
        // Given we have 4 trips with different prices
        $trip_one = create(Trip::class, ['price' => 1000])->makeVisible('en_name');
        
        $trip_two = create(Trip::class, ['price' => 2000])->makeVisible('en_name');

        $trip_three = create(Trip::class, ['price' => 4000])->makeVisible('en_name');
        
        $trip_four = create(Trip::class, ['price' => 500])->makeVisible('en_name');
    
        // When we hit search endpoint to search with "price_from"
        $search_price = 1000;
        $response = $this->getJson(route('api.trips.search', ['price_from' => $search_price]));

        // Then we should see only all trips After Or Equal "$search_price"
        $response->assertSee($trip_one->en_name);
        $response->assertSee($trip_two->en_name);
        $response->assertSee($trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);
        
        // When we hit search endpoint to search with "price_to"
        $search_price = 2000;
        $response = $this->getJson(route('api.trips.search', ['price_to' => $search_price]));

        // Then we should see only all trips Before Or Equal "$search_price"
        $response->assertSee($trip_one->en_name);
        $response->assertSee($trip_two->en_name);
        $response->assertDontSee($trip_three->en_name);
        $response->assertSee($trip_four->en_name);

        // When we hit search endpoint to search with "price_from" and "price_to"
        $search_start_price = 950;
        $search_end_price = 2550;
        $response = $this->getJson(route('api.trips.search', ['price_from' => $search_start_price, 'price_to' => $search_end_price]));

        // Then we should see only all trips Equal "$search_price"
        $response->assertSee($trip_one->en_name);
        $response->assertSee($trip_two->en_name);
        $response->assertDontSee($trip_three->en_name);
        $response->assertDontSee($trip_four->en_name);
    }
    
    /** @test */
    public function it_can_filter_and_order_by_price()
    {
        // Given we have 4 trips with different prices
        $trip_one = create(Trip::class, ['price' => 1000])->makeVisible('en_name');
        
        $trip_two = create(Trip::class, ['price' => 2000])->makeVisible('en_name');

        $trip_three = create(Trip::class, ['price' => 4000])->makeVisible('en_name');
        
        $trip_four = create(Trip::class, ['price' => 500])->makeVisible('en_name');
    
        // When we hit search endpoint to search with "price_low"
        $response = $this->getJson(route('api.trips.search', ['price_low' => true]));

        // Then we should see only all trips ordered by lower price
        $response->assertSeeInOrder([$trip_four->en_name, $trip_one->en_name, $trip_two->en_name, $trip_three->en_name]);
 
        // When we hit search endpoint to search with "price_high"
        $response = $this->getJson(route('api.trips.search', ['price_high' => true]));

        // Then we should see only all trips ordered by highest price
        $response->assertSeeInOrder([$trip_three->en_name, $trip_two->en_name, $trip_one->en_name, $trip_four->en_name]);
    }
    
    /** @test */
    public function it_can_filter_and_order_by_views()
    {
        // Given we have 4 trips with different views count
        $trip_one = create(Trip::class, ['views_count' => 10])->makeVisible('en_name');
        
        $trip_two = create(Trip::class, ['views_count' => 20])->makeVisible('en_name');

        $trip_three = create(Trip::class, ['views_count' => 40])->makeVisible('en_name');
        
        $trip_four = create(Trip::class, ['views_count' => 5])->makeVisible('en_name');
    
        // When we hit search endpoint to search with "most_popular"
        $response = $this->getJson(route('api.trips.search', ['most_popular' => true]));

        // Then we should see only all trips ordered by highest views count
        $response->assertSeeInOrder([$trip_three->en_name, $trip_two->en_name, $trip_one->en_name, $trip_four->en_name]);
    }
    
    /** @test */
    public function it_can_filter_and_order_by_created_date()
    {
        // Given we have 4 trips created in different times
        $trip_one = create(Trip::class, ['created_at' => now()->toDateString()])->makeVisible('en_name');
        
        $trip_two = create(Trip::class, ['created_at' => now()->addDay()->toDateString()])->makeVisible('en_name');

        $trip_three = create(Trip::class, ['created_at' => now()->addDays(2)->toDateString()])->makeVisible('en_name');
        
        $trip_four = create(Trip::class, ['created_at' => now()->subDay()->toDateString()])->makeVisible('en_name');
    
        // When we hit search endpoint to search with "most_recently"
        $response = $this->getJson(route('api.trips.search', ['most_recently' => true]));

        // Then we should see only all trips ordered by created_at date
        $response->assertSeeInOrder([$trip_three->en_name, $trip_two->en_name, $trip_one->en_name, $trip_four->en_name]);
    }

    /** @test */
    public function it_can_filter_by_categories()
    {
        // Given we have 4 trips, 2 of them belongs to different category and 2 of them belongs to all categories
        $safari_trip = create(Trip::class)->makeVisible('en_name');
        $tour_trip = create(Trip::class)->makeVisible('en_name');
        $safari_and_tour_trip_one = create(Trip::class)->makeVisible('en_name');
        $safari_and_tour_trip_two = create(Trip::class)->makeVisible('en_name');
        
        // Attach Trips To Categories
        $safari_trip->categories()->attach($this->safari_category);
        $tour_trip->categories()->attach($this->tour_category);
        
        $safari_and_tour_trip_one->categories()->attach($this->safari_category);
        $safari_and_tour_trip_one->categories()->attach($this->tour_category);

        $safari_and_tour_trip_two->categories()->attach($this->safari_category);
        $safari_and_tour_trip_two->categories()->attach($this->tour_category);        

        // When we hit search endpoint to search with "Safari" category
        $response = $this->getJson(route('api.trips.search', ['categories' => [$this->safari_category->id]]));

        // Then we should see only all "Safari" related trips
        $response->assertSee($safari_trip->en_name);
        $response->assertSee($safari_and_tour_trip_one->en_name);
        $response->assertSee($safari_and_tour_trip_two->en_name);
        $response->assertDontSee($tour_trip->en_name);
        
        // When we hit search endpoint to search with "Tour" category
        $response = $this->getJson(route('api.trips.search', ['categories' => [$this->tour_category->id]]));

        // Then we should see only all "Tour" related trips
        $response->assertDontSee($safari_trip->en_name);
        $response->assertSee($safari_and_tour_trip_one->en_name);
        $response->assertSee($safari_and_tour_trip_two->en_name);
        $response->assertSee($tour_trip->en_name);
        
        // When we hit search endpoint to search with "Safari" and "Tour" categories
        $response = $this->getJson(route('api.trips.search', ['categories' => [$this->safari_category->id, $this->tour_category->id]]));

        // Then we should see only all "Safari" and "Tour" related trips
        $response->assertSee($safari_trip->en_name);
        $response->assertSee($safari_and_tour_trip_one->en_name);
        $response->assertSee($safari_and_tour_trip_two->en_name);
        $response->assertSee($tour_trip->en_name);
    }

}