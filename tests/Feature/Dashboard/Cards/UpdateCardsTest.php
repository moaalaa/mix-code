<?php

namespace Tests\Feature\Dashboard\Cards;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use MixCode\Category;
use MixCode\City;
use MixCode\Country;
use MixCode\Feature;
use MixCode\Language;
use MixCode\Card;
use MixCode\User;
use Storage;

class UpdateCardsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');

        $this->visibleFields = [
            'en_name', 
            'ar_name', 
            'en_overview', 
            'ar_overview', 
            'en_highlights', 
            'ar_highlights'
        ];

        $this->relations = [
            'images'            => [UploadedFile::fake()->image('image.png')],
            'categories_id'     => [create(Category::class)->id],
            'features_id'       => [create(Feature::class)->id],
            'languages_id'      => [create(Language::class)->id],
        ];

        $this->admin = create(User::class, ['type' => User::ADMIN_TYPE]);
        $this->adminCard = create(Card::class, ['creator_id' => $this->admin->id])->makeVisible($this->visibleFields);
        
        $this->company = create(User::class, ['type' => User::COMPANY_TYPE]);
        $this->companyCard = create(Card::class, ['creator_id' => $this->company->id])->makeVisible($this->visibleFields);

        $this->card = create(Card::class)->makeVisible($this->visibleFields);
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_update_existing_card()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The card Update Endpoint
        $response = $this->patchJson(route('dashboard.cards.update', $this->card));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The card Update Endpoint
        $response = $this->patchJson(route('dashboard.cards.update', $this->card));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_update_their_existing_card()
    {
        // Given We Have An Admin And card
        $this->signInAsAdmin($this->admin);
        
        // Set Card Name
        $updated_data = ['en_name' => 'Updated Card Name'];
        $data = array_merge($this->adminCard->toArray(),  $updated_data, $this->relations);

        // When We Hit The card Update Endpoint
        $response = $this->patchJson(route('dashboard.cards.update', $this->adminCard), $data);

        // Then it Should Redirect to the card show page And The Card Name Should Be Updated
        $response->assertRedirect($this->adminCard->path());

        $this->assertEquals($updated_data, ['en_name' => $this->adminCard->fresh()->en_name]);
    }

    /** @test */
    public function authenticate_companies_can_update_their_existing_card()
    {
        // Given We Have A Company And card
        $this->signIn($this->company);
        
        // Set Card Name
        $updated_data = ['en_name' => 'Updated Card Name'];
        $data = array_merge($this->companyCard->toArray(),  $updated_data, $this->relations);

        // When We Hit The card Update Endpoint
        $response = $this->patchJson(route('dashboard.cards.update', $this->companyCard), $data);

        // Then it Should Redirect to the card show page And The Card Name Should Be Updated
        $response->assertRedirect($this->companyCard->path());

        $this->assertEquals($updated_data, ['en_name' => $this->companyCard->fresh()->en_name]);
    }

    /** @test */
    public function card_required_a_valid_en_name()
    {
        $this->updateCard(['en_name' => null])->assertSessionHasErrors('en_name');
    }
    
    /** @test */
    public function card_required_a_valid_ar_name()
    {
        $this->updateCard(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }
    
    /** @test */
    public function card_required_a_valid_price()
    {
        $this->updateCard(['price' => 'not-valid-price'])->assertSessionHasErrors('price');
        $this->updateCard(['price' => null])->assertSessionHasErrors('price');
        $this->updateCard(['price' => 123.45])->assertSessionHasNoErrors('price');
    }
    
    /** @test */
    public function card_required_a_valid_duration()
    {
        $this->updateCard(['duration' => null])->assertSessionHasErrors('duration');   
    }
    
    /** @test */
    public function card_required_a_valid_date_from_and_it_must_be_before_or_equals_date_to()
    {
        $this->updateCard(['date_from' => null])->assertSessionHasErrors('date_from');   
        $this->updateCard(['date_from' => '2020-02-02', 'date_to' => '2020-02-01'])->assertSessionHasErrors('date_from');   
        $this->updateCard(['date_from' => '2020-02-02', 'date_to' => '2020-02-02'])->assertSessionHasNoErrors('date_from');   
        $this->updateCard(['date_from' => '2020-02-02', 'date_to' => '2020-02-03'])->assertSessionHasNoErrors('date_from');   
    }

    /** @test */
    public function card_required_a_valid_date_to_and_it_must_be_after_or_equals_date_from()
    {
        $this->updateCard(['date_to' => null])->assertSessionHasErrors('date_to');   
        $this->updateCard(['date_to' => '2020-02-01', 'date_from' => '2020-02-02'])->assertSessionHasErrors('date_to');   
        $this->updateCard(['date_to' => '2020-02-02', 'date_from' => '2020-02-02'])->assertSessionHasNoErrors('date_to');   
        $this->updateCard(['date_to' => '2020-02-03', 'date_from' => '2020-02-02'])->assertSessionHasNoErrors('date_to');   
    }
    
    /** @test */
    public function card_required_a_valid_en_overview()
    {
        $this->updateCard(['en_overview' => null])->assertSessionHasErrors('en_overview');
    }
    
    /** @test */
    public function card_required_a_valid_ar_overview()
    {
        $this->updateCard(['ar_overview' => null])->assertSessionHasErrors('ar_overview');
    }
    
    /** @test */
    public function card_required_a_valid_en_highlights()
    {
        $this->updateCard(['en_highlights' => null])->assertSessionHasErrors('en_highlights');
    }
    
    /** @test */
    public function card_required_a_valid_ar_highlights()
    {
        $this->updateCard(['ar_highlights' => null])->assertSessionHasErrors('ar_highlights');
    }
    
    /** @test */
    public function card_required_a_valid_integer_adults_number()
    {
        $this->updateCard(['adults' => null])->assertSessionHasErrors('adults');
    }
    
    /** @test */
    public function card_required_a_valid_integer_children_number()
    {
        $this->updateCard(['children' => null])->assertSessionHasErrors('children');
    }
    
    /** @test */
    public function card_required_a_valid_integer_infant_number()
    {
        $this->updateCard(['infant' => null])->assertSessionHasErrors('infant');
    }

    /** @test */
    public function card_require_a_valid_and_exists_country()
    {
        $this->updateCard(['country_id' => 'not-valid-country'])->assertSessionHasErrors('country_id');
        $this->updateCard(['country_id' => null])->assertSessionHasErrors('country_id');
        $this->updateCard(['country_id' => create(Country::class)->id])->assertSessionHasNoErrors('country_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_city()
    {
        $this->updateCard(['city_id' => 'not-valid-city'])->assertSessionHasErrors('city_id');
        $this->updateCard(['city_id' => null])->assertSessionHasErrors('city_id');
        $this->updateCard(['city_id' => create(City::class)->id])->assertSessionHasNoErrors('city_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_categories()
    {
        $this->updateCard(['categories_id' => 'not-valid-categories'])->assertSessionHasErrors('categories_id');
        $this->updateCard(['categories_id' => null])->assertSessionHasErrors('categories_id');
        $this->updateCard(['categories_id' => [create(Category::class)->id]])->assertSessionHasNoErrors('categories_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_features()
    {
        $this->updateCard(['features_id' => 'not-valid-features'])->assertSessionHasErrors('features_id');
        $this->updateCard(['features_id' => null])->assertSessionHasErrors('features_id');
        $this->updateCard(['features_id' => [create(Feature::class)->id]])->assertSessionHasNoErrors('features_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_languages()
    {
        $this->updateCard(['languages_id' => 'not-valid-languages'])->assertSessionHasErrors('languages_id');
        $this->updateCard(['languages_id' => null])->assertSessionHasErrors('languages_id');
        $this->updateCard(['languages_id' => [create(Language::class)->id]])->assertSessionHasNoErrors('languages_id');
    }

    /** @test */
    public function card_may_accept_a_valid_images()
    {
        $this->updateCard(['images' => 'not-valid-url'])->assertSessionHasErrors('images');
        $this->updateCard(['images' => null])->assertSessionHasNoErrors('images');
    }

    protected function updateCard($data)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And card
        $this->signInAsAdmin($this->admin);

        $data = array_merge($this->card->toArray(), $this->relations, $data);

        // When We Hit The card Update Endpoint
        return $this->patch(route('dashboard.cards.update', $this->card), $data);
    }
}
