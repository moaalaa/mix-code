<?php

namespace Tests\Language\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Language;

class LanguageApiTest extends TestCase
{
    use RefreshDatabase;
 
    /** @test */
    public function it_can_read_single_language()
    {
        // Given We Have A Language        
        $language = create(Language::class);
        
        // When We Hit The Language Read Endpoint
        $response = $this->getJson($language->apiPath());
        
        // Then It Should Get The Language That Was Created
        $response->assertOk();
        $this->assertContains($language->en_name, $response->json());
    }

    /** @test */
    public function it_can_read_all_languages()
    {
        // Given We Have "3" languages        
        $languages = create(Language::class, [], 3);

        // When We Hit The Language Read Endpoint
        $response = $this->getJson(route('api.languages.index'));
        
        // Then It Should Get The "3" languages That Was Created
        $response->assertOk();
        $response->assertSee($languages->first()->name);
        $response->assertSee($languages->get(1)->name);
        $response->assertSee($languages->last()->name);
    }
}