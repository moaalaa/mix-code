<?php

namespace Tests\Feature\Dashboard\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Category;

class ReadCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_read_single_category()
    {
        $this->readCategory(create(Category::class)->path());
    }

    /** @test */
    public function non_authenticate_administrators_cant_read_all_category()
    {
        $this->readCategory(route('dashboard.categories.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_single_category()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $category = create(Category::class);

        // When We Hit The Category Read Endpoint
        $response = $this->getJson($category->path());
        
        // Then It Should Get The Category That Was Created
        $response->assertOk();
        $this->assertEquals($category->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_all_category()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $categories = create(Category::class, [], 3);

        // When We Hit The Category Read Endpoint
        $response = $this->getJson(route('dashboard.categories.index'));
        
        // Then It Should Get The "3" Categories That Was Created
        $response->assertOk();
        $response->assertSee($categories->first()->en_name);
        $response->assertSee($categories->get(1)->en_name);
        $response->assertSee($categories->last()->en_name);
    }

    protected function readCategory($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The Category Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Category Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}