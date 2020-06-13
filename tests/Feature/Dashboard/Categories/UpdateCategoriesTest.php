<?php

namespace Tests\Feature\Dashboard\Categories;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use MixCode\Category;

class UpdateCategoriesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');

        $this->category = create(Category::class);
    }

    /** @test */
    public function non_authenticate_administrators_cant_update_existing_category()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin
        $this->signIn();

        // When We Hit The Category Update Endpoint
        $response = $this->patchJson(route('dashboard.categories.update', $this->category));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The Category Update Endpoint
        $response = $this->patchJson(route('dashboard.categories.update', $this->category));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_existing_category()
    {
        // Given We Have An Admin And Category
        $this->signInAsAdmin();
        
        // Set Category Name
        $updated_data = ['en_name' => 'Updated Category Name'];
        $data = array_merge($this->category->toArray(),  $updated_data, ['icon' => UploadedFile::fake()->create('icon.png')]);

        // When We Hit The Category Update Endpoint
        $response = $this->patchJson(route('dashboard.categories.update', $this->category), $data);

        // Then it Should Redirect to the category show page And The Category name Should Be Updated
        $response->assertRedirect($this->category->path());

        $this->assertEquals($updated_data, ['en_name' => $this->category->fresh()->en_name]);
    }

    /** @test */
    public function category_required_a_valid_en_name()
    {
        $this->updateCategory(['en_name' => null])->assertSessionHasErrors('en_name');
    }

    /** @test */
    public function category_required_a_valid_ar_name()
    {
        $this->updateCategory(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }

    /** @test */
    public function category_require_a_valid_status()
    {
        $this->updateCategory(['status' => 'not-valid-status'])->assertSessionHasErrors('status');
        $this->updateCategory(['status' => null])->assertSessionHasErrors('status');
        $this->updateCategory(['status' => Category::ACTIVE_STATUS])->assertSessionHasNoErrors('status');
        $this->updateCategory(['status' => Category::INACTIVE_STATUS])->assertSessionHasNoErrors('status');
    }

    /** @test */
    public function category_require_a_valid_icon_image()
    {
        $this->updateCategory(['icon' => 'not-valid-media-file'])->assertSessionHasErrors('icon');
    }

    protected function updateCategory($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And Category
        $this->signInAsAdmin();

        $data = array_merge($this->category->toArray(), ['icon' => UploadedFile::fake()->create('icon.png')], $data);

        // When We Hit The Category Update Endpoint
        return $this->patch(route('dashboard.categories.update', $this->category), $data);
    }
}
