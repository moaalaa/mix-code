<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Feature;

class FeatureApiTest extends TestCase
{
    use RefreshDatabase;
 
    /** @test */
    public function it_can_read_single_feature()
    {
        // Given We Have A Feature        
        $feature = create(Feature::class);
        
        // When We Hit The Feature Read Endpoint
        $response = $this->getJson($feature->apiPath());
        
        // Then It Should Get The Feature That Was Created
        $response->assertOk();
        $this->assertContains($feature->en_name, $response->json());
    }

    /** @test */
    public function it_can_read_all_features()
    {
        // Given We Have "3" Features        
        $features = create(Feature::class, [], 3);

        // When We Hit The Feature Read Endpoint
        $response = $this->getJson(route('api.features.index'));
        
        // Then It Should Get The "3" Categories That Was Created
        $response->assertOk();
        $response->assertSee($features->first()->name);
        $response->assertSee($features->get(1)->name);
        $response->assertSee($features->last()->name);
    }
}