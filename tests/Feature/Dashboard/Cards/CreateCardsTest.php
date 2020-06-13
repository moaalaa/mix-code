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

class CreateCardsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('test');

        $this->relations = [
            'images'            => [UploadedFile::fake()->image('image.png')],
            'categories_id'     => [create(Category::class)->id],
            'features_id'       => [create(Feature::class)->id],
            'languages_id'      => [create(Language::class)->id],
        ];

        $this->visibleFields = [
            'en_name', 
            'ar_name', 
            'en_overview', 
            'ar_overview', 
            'en_highlights', 
            'ar_highlights'
        ];
    }

    /** @test */
    public function non_authenticate_or_companies_administrators_cant_create_new_card()
    {
        $this->withExceptionHandling();

        // Given We Have A User Not An Admin Or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The card Store Endpoint
        $response = $this->postJson(route('dashboard.cards.store'));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The card Store Endpoint
        $response = $this->postJson(route('dashboard.cards.store'));

        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_create_new_card()
    {
        // Given We Have An Admin And card
        $this->signInAsAdmin();

        $card = make(Card::class)->makeVisible($this->visibleFields);
        
        $data = array_merge($card->toArray(), $this->relations);

        // When We Hit The card Store Endpoint
        $this->postJson(route('dashboard.cards.store'), $data);

        // Then cards Count Should Be 1
        $this->assertEquals(1, Card::count());
    }

    /** @test */
    public function authenticate_companies_can_create_new_card()
    {
        // Given We Have A Company And card
        $this->signIn(create(User::class, ['type' => User::COMPANY_TYPE]));

        $card = make(Card::class)->makeVisible($this->visibleFields);
        $data = array_merge($card->toArray(), $this->relations);
        
        // When We Hit The card Store Endpoint
        $this->postJson(route('dashboard.cards.store'), $data);

        // Then cards Count Should Be 1
        $this->assertEquals(1, Card::count());
    }

    /** @test */
    public function card_required_a_valid_en_name()
    {
        $this->createNewCard(['en_name' => null])->assertSessionHasErrors('en_name');
    }

    /** @test */
    public function card_required_a_valid_ar_name()
    {
        $this->createNewCard(['ar_name' => null])->assertSessionHasErrors('ar_name');
    }

    /** @test */
    public function card_required_a_valid_price()
    {
        $this->createNewCard(['price' => 'not-valid-price'])->assertSessionHasErrors('price');
        $this->createNewCard(['price' => null])->assertSessionHasErrors('price');
        $this->createNewCard(['price' => 123.45])->assertSessionHasNoErrors('price');
    }

    /** @test */
    public function card_required_a_valid_duration()
    {
        $this->createNewCard(['duration' => null])->assertSessionHasErrors('duration');
    }

    /** @test */
    public function card_required_a_valid_date_from_and_it_must_be_before_or_equals_date_to()
    {
        $this->createNewCard(['date_from' => null])->assertSessionHasErrors('date_from');
        $this->createNewCard(['date_from' => '2020-02-02', 'date_to' => '2020-02-01'])->assertSessionHasErrors('date_from');
        $this->createNewCard(['date_from' => '2020-02-02', 'date_to' => '2020-02-02'])->assertSessionHasNoErrors('date_from');
        $this->createNewCard(['date_from' => '2020-02-02', 'date_to' => '2020-02-03'])->assertSessionHasNoErrors('date_from');
    }

    /** @test */
    public function card_required_a_valid_date_to_and_it_must_be_after_or_equals_date_from()
    {
        $this->createNewCard(['date_to' => null])->assertSessionHasErrors('date_to');
        $this->createNewCard(['date_to' => '2020-02-01', 'date_from' => '2020-02-02'])->assertSessionHasErrors('date_to');
        $this->createNewCard(['date_to' => '2020-02-02', 'date_from' => '2020-02-02'])->assertSessionHasNoErrors('date_to');
        $this->createNewCard(['date_to' => '2020-02-03', 'date_from' => '2020-02-02'])->assertSessionHasNoErrors('date_to');
    }

    /** @test */
    public function card_required_a_valid_en_overview()
    {
        $this->createNewCard(['en_overview' => null])->assertSessionHasErrors('en_overview');
    }

    /** @test */
    public function card_required_a_valid_ar_overview()
    {
        $this->createNewCard(['ar_overview' => null])->assertSessionHasErrors('ar_overview');
    }

    /** @test */
    public function card_required_a_valid_en_highlights()
    {
        $this->createNewCard(['en_highlights' => null])->assertSessionHasErrors('en_highlights');
    }

    /** @test */
    public function card_required_a_valid_ar_highlights()
    {
        $this->createNewCard(['ar_highlights' => null])->assertSessionHasErrors('ar_highlights');
    }

    /** @test */
    public function card_required_a_valid_integer_adults_number()
    {
        $this->createNewCard(['adults' => null])->assertSessionHasErrors('adults');
    }

    /** @test */
    public function card_required_a_valid_integer_children_number()
    {
        $this->createNewCard(['children' => null])->assertSessionHasErrors('children');
    }

    /** @test */
    public function card_required_a_valid_integer_infant_number()
    {
        $this->createNewCard(['infant' => null])->assertSessionHasErrors('infant');
    }

    /** @test */
    public function card_require_a_valid_and_exists_country()
    {
        $this->createNewCard(['country_id' => 'not-valid-country'])->assertSessionHasErrors('country_id');
        $this->createNewCard(['country_id' => null])->assertSessionHasErrors('country_id');
        $this->createNewCard(['country_id' => create(Country::class)->id])->assertSessionHasNoErrors('country_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_city()
    {
        $this->createNewCard(['city_id' => 'not-valid-city'])->assertSessionHasErrors('city_id');
        $this->createNewCard(['city_id' => null])->assertSessionHasErrors('city_id');
        $this->createNewCard(['city_id' => create(City::class)->id])->assertSessionHasNoErrors('city_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_categories()
    {
        $this->createNewCard(['categories_id' => 'not-valid-categories'])->assertSessionHasErrors('categories_id');
        $this->createNewCard(['categories_id' => null])->assertSessionHasErrors('categories_id');
        $this->createNewCard(['categories_id' => [create(Category::class)->id]])->assertSessionHasNoErrors('categories_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_features()
    {
        $this->createNewCard(['features_id' => 'not-valid-features'])->assertSessionHasErrors('features_id');
        $this->createNewCard(['features_id' => null])->assertSessionHasErrors('features_id');
        $this->createNewCard(['features_id' => [create(Feature::class)->id]])->assertSessionHasNoErrors('features_id');
    }

    /** @test */
    public function card_require_a_valid_and_exists_languages()
    {
        $this->createNewCard(['languages_id' => 'not-valid-languages'])->assertSessionHasErrors('languages_id');
        $this->createNewCard(['languages_id' => null])->assertSessionHasErrors('languages_id');
        $this->createNewCard(['languages_id' => [create(Language::class)->id]])->assertSessionHasNoErrors('languages_id');
    }

    /** @test */
    public function card_may_accept_a_valid_images()
    {
        $this->createNewCard(['images' => 'not-valid-url'])->assertSessionHasErrors('images');
        $this->createNewCard(['images' => null])->assertSessionHasErrors('images');
    }

    protected function createNewCard($overrides)
    {
        $this->withExceptionHandling();

        // Given We Have An Admin And card
        $this->signInAsAdmin();

        $overrides = array_merge($this->relations, $overrides);

        $card = make(Card::class, $overrides)->makeVisible($this->visibleFields);

        // When We Hit The card Store Endpoint
        return $this->post(route('dashboard.cards.store'), $card->toArray());
    }
}
