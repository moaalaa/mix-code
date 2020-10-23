<?php

namespace Tests\Feature\Dashboard\Settings;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Setting;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hiddenFields = [
            'about_us_by_lang', 
            'vision_by_lang', 
            'mission_by_lang', 
            'values_by_lang', 
            'terms_and_conditions_by_lang', 
            'call_to_action_by_lang',
        ];
    }

    /** @test */
    public function non_authenticate_administrators_cant_create_or_update_settings()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The Event Store Endpoint
        $response = $this->postJson(route('dashboard.settings.store'));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Event Store Endpoint
        $response = $this->postJson(route('dashboard.settings.store'));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_edit_settings()
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And No Existing Settings
        $this->signInAsAdmin();
        $settings = make(Setting::class);

        // When We Hit The Settings Store Endpoint
        $this->postJson(route('dashboard.settings.store'), $settings->toArray());

        $this->assertEquals(1, Setting::count());

        $this->assertDatabaseHas('settings', $settings->makeHidden($this->hiddenFields)->toArray());
    }

    /** @test */
    public function authenticate_administrators_can_update_or_overwrite_existing_settings()
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And And Existing Settings
        $this->signInAsAdmin();
        $settings = create(Setting::class, ['name' => 'new site']);

        $this->assertEquals(1, Setting::count());

        $data = $settings->toArray();
        $data['name'] = 'updated name';

        // When We Hit The Settings Store Endpoint
        $this->postJson(route('dashboard.settings.store'), $data);

        $this->assertEquals('updated name', Setting::first()->name);
    }
}
