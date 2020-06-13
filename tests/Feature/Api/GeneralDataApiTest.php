<?php

namespace Tests\GeneralData\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Setting;

class GeneralDataApiTest extends TestCase
{
    use RefreshDatabase;
 
    /** @test */
    public function it_can_read_all_application_general_setting_data()
    {
        // Given We Have A Settings Data
        create(Setting::class, ['name' => 'My App']);
        
        // When We Hit The General Settings Data Endpoint
        $response = $this->getJson(route('api.general.index'));
        
        // Then It Should Get The General Data
        $response->assertOk();
        $this->assertContains('My App', $response->json());
    }
}