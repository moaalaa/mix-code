<?php

namespace Tests\Feature\Dashboard\Cards;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Card;
use MixCode\CardView;
use MixCode\User;

class DeleteCardsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->visibleFields = [
            'en_name', 
            'ar_name', 
            'en_overview', 
            'ar_overview', 
            'en_highlights', 
            'ar_highlights'
        ];
        
        $this->admin = create(User::class, ['type' => User::ADMIN_TYPE]);
        $this->adminCard = create(Card::class, ['creator_id' => $this->admin->id])->makeVisible($this->visibleFields);
        
        $this->company = create(User::class, ['type' => User::COMPANY_TYPE]);
        $this->companyCard = create(Card::class, ['creator_id' => $this->company->id])->makeVisible($this->visibleFields);
    
        $this->card = create(Card::class)->makeVisible($this->visibleFields);
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_delete_existing_card()
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin Or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));
        
        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroy', $this->card));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroy', $this->card));
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
    }

    /** @test */
    public function authenticate_administrators_can_delete_their_existing_card()
    { 
        // Given We Have An Admin And card
        $this->signInAsAdmin($this->admin);
        
        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroy', $this->adminCard));
                
        // Then it Should Redirect to the card index page after delete the card
        $response->assertRedirect(route('dashboard.cards.index'));
        $this->assertDatabaseMissing('cards', $this->adminCard->toArray());
        $this->assertEquals(2, Card::count());
    }

    /** @test */
    public function authenticate_administrators_can_restore_their_existing_card()
    { 
        // Given We Have An Admin And Deleted card
        $this->signInAsAdmin($this->admin);

        $this->adminCard->delete();

        // When We Hit The card Delete Endpoint
        $response = $this->patchJson(route('dashboard.cards.restore', $this->adminCard));
                
        // Then it Should Redirect to the card trashed index page after delete the card
        $response->assertRedirect(route('dashboard.cards.trashed'));
        $this->assertEquals(3, Card::count());
    }

    /** @test */
    public function authenticate_administrators_can_delete_their_existing_card_forever()
    { 
        // Given We Have An Admin And Deleted card
        $this->signInAsAdmin($this->admin);
        
        $this->adminCard->delete();
        
        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.force_delete', $this->adminCard));
        
        // Then it Should Redirect to the card trashed index page after delete the card
        $response->assertRedirect(route('dashboard.cards.trashed'));
        $this->assertEquals(2, Card::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_administrators_can_multi_delete_their_existing_cards()
    { 
        // Given We Have An Admin And cards
        $this->signInAsAdmin($this->admin);
        $ids = create(Card::class, ['creator_id' => $this->admin->id], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->adminCard->id]);
        
        // When We Hit The card multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the card index page after delete the card
        $response->assertRedirect(route('dashboard.cards.index'));
        $this->assertDatabaseMissing('cards', $ids);
        $this->assertEquals(2, Card::count());
    }

    /** @test */
    public function authenticate_companies_can_delete_their_existing_card()
    { 
        // Given We Have A Company And card
        $this->signIn($this->company);
        
        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroy', $this->companyCard));
                
        // Then it Should Redirect to the card index page after delete the card
        $response->assertRedirect(route('dashboard.cards.index'));
        $this->assertDatabaseMissing('cards', $this->companyCard->toArray());
        $this->assertEquals(2, Card::count());
    }

    /** @test */
    public function authenticate_companies_can_restore_their_existing_card()
    { 
        // Given We Have A Company And Deleted card
        $this->signIn($this->company);

        $this->companyCard->delete();

        // When We Hit The card Delete Endpoint
        $response = $this->patchJson(route('dashboard.cards.restore', $this->companyCard));
                
        // Then it Should Redirect to the card trashed index page after delete the card
        $response->assertRedirect(route('dashboard.cards.trashed'));
        $this->assertEquals(3, Card::count());
    }

    /** @test */
    public function authenticate_companies_can_delete_their_existing_card_forever()
    { 
        // Given We Have A Company And Deleted card
        $this->signIn($this->company);
        
        $this->companyCard->delete();
        
        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.force_delete', $this->companyCard));
        
        // Then it Should Redirect to the card trashed index page after delete the card
        $response->assertRedirect(route('dashboard.cards.trashed'));
        $this->assertEquals(2, Card::withTrashed()->count());
    }
    

    /** @test */
    public function authenticate_companies_can_multi_delete_their_existing_cards()
    { 
        // Given We Have A Company And cards
        $this->signIn($this->company);
        $ids = create(Card::class, ['creator_id' => $this->company->id], 3)->pluck('id')->toArray();
        $ids = array_merge($ids, [$this->companyCard->id]);
        
        // When We Hit The card multi Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroyGroup'), ['selected_data' => $ids]);
                
        // Then it Should Redirect to the card index page after delete the card
        $response->assertRedirect(route('dashboard.cards.index'));
        $this->assertDatabaseMissing('cards', $ids);
        $this->assertEquals(2, Card::count());
    }

    /** @test */
    public function it_delete_views_with_it()
    { 
        // Given We Have An Admin And card have views relation
        $this->signInAsAdmin($this->admin);
        
        $this->adminCard->views()->attach(auth()->id());

        // -- Increase card View Field Count
        $this->adminCard->increment('views_count');
        
        // When We Hit The card Delete Endpoint
        $response = $this->deleteJson(route('dashboard.cards.destroy', $this->adminCard));
        
        // Then it Should Redirect to card index page after delete card and it's views
        $response->assertRedirect(route('dashboard.cards.index'));
        $this->assertEquals(0, CardView::count());
        $this->assertEquals(0, $this->adminCard->fresh()->views_count);
    }
}