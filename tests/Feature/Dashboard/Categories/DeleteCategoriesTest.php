<?php

namespace Tests\Feature\Dashboard\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Category;

class DeleteCategoriesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->category = create(Category::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_delete_existing_category()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The Category Delete Endpoint
        $response = $this->deleteJson(route('dashboard.categories.destroy', $this->category));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Category Delete Endpoint
        $response = $this->deleteJson(route('dashboard.categories.destroy', $this->category));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_category()
    { 
        // Given We Have An Admin And Category
        $this->signInAsAdmin();
        
        // When We Hit The Category Delete Endpoint
        $response = $this->deleteJson(route('dashboard.categories.destroy', $this->category));
                
        // Then it Should Redirect to the category index page after delete the category
        $response->assertRedirect(route('dashboard.categories.index'));
        $this->assertDatabaseMissing('categories', $this->category->toArray());
        $this->assertEquals(0, Category::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_existing_category()
    { 
        // Given We Have An Admin And Deleted Category
        $this->signInAsAdmin();

        $this->category->delete();

        // When We Hit The Category Delete Endpoint
        $response = $this->patchJson(route('dashboard.categories.restore', $this->category));
                
        // Then it Should Redirect to the category trashed index page after delete the category
        $response->assertRedirect(route('dashboard.categories.trashed'));
        $this->assertEquals(1, Category::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_existing_category_forever()
    { 
        // Given We Have An Admin And Deleted Category
        $this->signInAsAdmin();
        
        $this->category->delete();
        
        // When We Hit The Category Delete Endpoint
        $response = $this->deleteJson(route('dashboard.categories.force_delete', $this->category));
        
        // Then it Should Redirect to the category trashed index page after delete the category
        $response->assertRedirect(route('dashboard.categories.trashed'));
        $this->assertEquals(0, Category::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_administrators_can_multi_delete_existing_categories()
    { 
        // Given We Have An Admin And Categories
        $this->signInAsAdmin();
        $ids = create(Category::class, [], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->category->id]);
        
        // When We Hit The Category multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.categories.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the category index page after delete the category
        $response->assertRedirect(route('dashboard.categories.index'));
        $this->assertDatabaseMissing('categories', $ids);
        $this->assertEquals(0, Category::count());
    }
}