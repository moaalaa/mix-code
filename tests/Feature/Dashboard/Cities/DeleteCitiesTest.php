<?php

namespace Tests\Feature\Dashboard\Cities;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\City;

class DeleteCitiesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->city = create(City::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_delete_existing_city()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The City Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cities.destroy', $this->city));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The City Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cities.destroy', $this->city));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_city()
    { 
        // Given We Have An Admin And City
        $this->signInAsAdmin();
        
        // When We Hit The City Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cities.destroy', $this->city));
                
        // Then it Should Redirect to the city index page after delete the city
        $response->assertRedirect(route('dashboard.cities.index'));
        $this->assertDatabaseMissing('cities', $this->city->toArray());
        $this->assertEquals(0, City::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_existing_city()
    { 
        // Given We Have An Admin And Deleted City
        $this->signInAsAdmin();

        $this->city->delete();

        // When We Hit The City Delete Endpoint
        $response = $this->patchJson(route('dashboard.cities.restore', $this->city));
                
        // Then it Should Redirect to the city trashed index page after delete the city
        $response->assertRedirect(route('dashboard.cities.trashed'));
        $this->assertEquals(1, City::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_city_forever()
    { 
        // Given We Have An Admin And Deleted City
        $this->signInAsAdmin();
        
        $this->city->delete();
        
        // When We Hit The City Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cities.force_delete', $this->city));
        
        // Then it Should Redirect to the city trashed index page after delete the city
        $response->assertRedirect(route('dashboard.cities.trashed'));
        $this->assertEquals(0, City::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_administrators_can_multi_delete_existing_cities()
    { 
        // Given We Have An Admin And Cities
        $this->signInAsAdmin();
        $ids = create(City::class, [], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->city->id]);
        
        // When We Hit The City multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cities.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the city index page after delete the city
        $response->assertRedirect(route('dashboard.cities.index'));
        $this->assertDatabaseMissing('cities', $ids);
        $this->assertEquals(0, City::count());
    }
}