<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\City;
use MixCode\Country;
use MixCode\Review;
use MixCode\Card;
use MixCode\User;

class cardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->card = create(Card::class);
    }

    /** @test */
    public function it_belongs_to_creator()
    {
        $this->assertInstanceOf(User::class, $this->card->creator);
    }

    /** @test */
    public function it_belongs_to_country()
    {
        $this->assertInstanceOf(Country::class, $this->card->country);
    }

    /** @test */
    public function it_belongs_to_city()
    {
        $this->assertInstanceOf(City::class, $this->card->city);
    }

    /** @test */
    public function it_have_many_categories()
    {
        $this->assertInstanceOf(Collection::class, $this->card->categories);
    }

    /** @test */
    public function it_have_many_features()
    {
        $this->assertInstanceOf(Collection::class, $this->card->features);
    }

    /** @test */
    public function it_have_many_languages()
    {
        $this->assertInstanceOf(Collection::class, $this->card->languages);
    }
    
    /** @test */
    public function it_have_many_views()
    {
        $this->assertInstanceOf(Collection::class, $this->card->views);
    }
    
    /** @test */
    public function it_have_many_reviews()
    {
        $this->assertInstanceOf(Collection::class, $this->card->reviews);
    }
    
    /** @test */
    public function it_belongs_to_many_favorites()
    {
        $this->assertInstanceOf(Collection::class, $this->card->favorites);
    }
    
    /** @test */
    public function it_can_determine_its_dashboard_path()
    {
        $this->assertEquals(route('dashboard.cards.show', $this->card), $this->card->path());
    }
    
    /** @test */
    public function it_can_submit_new_review()
    {
        $this->assertEquals(0, $this->card->reviews()->count());
        $this->assertFalse($this->card->reviews()->exists());

        $this->card->submitReview(create(Review::class)->toArray());

        $this->assertEquals(1, $this->card->reviews()->count());
        $this->assertTrue($this->card->reviews()->exists());
    }
 
    /** @test */
    public function it_can_mark_as_favorite()
    {
        $this->signIn();
        
        $this->assertFalse($this->card->isFavorited());
        
        $this->card->markAsFavorite();
        
        $this->assertTrue($this->card->isFavorited());
    }
 
    /** @test */
    public function it_can_mark_as_un_favorite()
    {
        $this->signIn();

        $this->card->markAsFavorite();
        
        $this->assertTrue($this->card->isFavorited());
        
        $this->card->markAsUnFavorite();
        
        $this->assertFalse($this->card->isFavorited());
    }
 
}