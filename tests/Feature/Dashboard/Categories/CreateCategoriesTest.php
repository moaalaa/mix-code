<?php

namespace Tests\Feature\Dashboard\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MixCode\Category;

class CreateCategoriesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');
    }

    /** @test */
    public function non_authenticate_administrators_cant_create_new_category()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin
        $this->signIn();
        
        // When We Hit The Category Store Endpoint
        $response = $this->postJson(route('dashboard.categories.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Category Store Endpoint
        $response = $this->postJson(route('dashboard.categories.store'));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_create_new_category()
    { 
        // Given We Have An Admin And Category
        $this->signInAsAdmin();
        
        $category = make(Category::class);

        $data = array_merge($category->toArray(), ['icon' => UploadedFile::fake()->create('icon.png')]);
        
        // When We Hit The Category Store Endpoint
        $this->postJson(route('dashboard.categories.store'), $data);
        
        // Then Categories Count Should Be 1
        $this->assertEquals(1, Category::count());
    }

    /** @test */
    public function category_required_a_valid_en_name()
    {
        $this->createNewCategory(['en_name' => null])->assertSessionHasErrors('en_name');
    }
    
    /** @test */
    public function category_required_a_valid_ar_name()
    {
        $this->createNewCategory(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }
    
    /** @test */
    public function category_require_a_valid_status()
    {
        $this->createNewCategory(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->createNewCategory(['status' => null])->assertSessionHasErrors('status');
        $this->createNewCategory(['status' => Category::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->createNewCategory(['status' => Category::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }

    /** @test */
    public function category_may_accept_a_valid_icon_image()
    {
        $this->createNewCategory(['icon' => 'not-valid-media-file'])->assertSessionHasErrors('icon');
    }
    
    protected function createNewCategory($overrides)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Category
        $this->signInAsAdmin();
        
        $data = array_merge(make(Category::class)->toArray(), ['icon' => UploadedFile::fake()->create('icon.png')], $overrides);

        // When We Hit The Category Store Endpoint
        return $this->post(route('dashboard.categories.store'), $data);
    }
}