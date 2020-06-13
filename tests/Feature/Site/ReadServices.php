<?php

namespace Tests\Feature\Site;

use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Service;

class ReadServicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_and_authenticated_users_can_list_all_services()
    {
        // Given we have a 3 services
        $services     = create(Service::class, [], 3);
        

        // When We Visit All Services Page
        $response = $this->get(route('services.index'));

        // Then We Should See the 3 services listed
        $response->assertSee($services->first()->name_by_lang);
        $response->assertSee($services->get(1)->name_by_lang);
        $response->assertSee($services->last()->name_by_lang);
    }

    /** @test */
    // public function guest_and_authenticated_users_can_show_service_details()
    // {
    //     // Given we have a 1 service
    //     // When We Visit Show Service Page
    //     tap(create(Service::class), function ($service) {

    //         $response = $this->get($service->viewPath());
    
    //         // Then We Should See the service details
            
    //         $response->assertSee($service->name_by_lang);
    //     });

    // }
}