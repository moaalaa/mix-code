<?php

namespace Tests\Feature\Dashboard\Cards;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Card;
use MixCode\User;

class ReadCardsTest extends TestCase
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
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_read_single_card()
    {
        $this->readCard(create(Card::class)->path());
    }

    /** @test */
    public function non_authenticate_administrators_or_companies_cant_read_all_card()
    {
        $this->readCard(route('dashboard.cards.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_their_single_card()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin($this->admin);

        // When We Hit The card Read Endpoint
        $response = $this->getJson($this->adminCard->path());
        
        // Then It Should Get The card That Was Created
        $response->assertOk();
        $this->assertEquals($this->adminCard->en_name, $response->json()['name_by_lang']);
    }

    /** @test */
    public function authenticate_administrators_can_read_all_their_card()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin($this->admin);
        
        $cards = create(Card::class, ['creator_id' => $this->admin->id], 3);

        // When We Hit The card Read Endpoint
        $response = $this->getJson(route('dashboard.cards.index'));
        
        // Then It Should Get The "3" cards That Was Created
        $response->assertOk();
        $response->assertSee($cards->first()->en_name);
        $response->assertSee($cards->get(1)->en_name);
        $response->assertSee($cards->last()->en_name);
    }

    /** @test */
    public function authenticate_companies_can_read_their_single_card()
    {
        // Given We Have A Authenticated Company
        $this->signIn($this->company);

        // When We Hit The card Read Endpoint
        $response = $this->getJson($this->companyCard->path());
        
        // Then It Should Get The card That Was Created
        $response->assertOk();
        $this->assertEquals($this->companyCard->en_name, $response->json()['name_by_lang']);
    }

    /** @test */
    public function authenticate_companies_can_read_all_their_card()
    {
        // Given We Have A Authenticated Company
        $this->signIn($this->company);
        
        $cards = create(Card::class, ['creator_id' => $this->company->id], 3);

        // When We Hit The card Read Endpoint
        $response = $this->getJson(route('dashboard.cards.index'));
        
        // Then It Should Get The "3" cards That Was Created
        $response->assertOk();
        $response->assertSee($cards->first()->en_name);
        $response->assertSee($cards->get(1)->en_name);
        $response->assertSee($cards->last()->en_name);
    }

    protected function readCard($route)
    {
        $this->withExceptionHandling();
        
        // Given We Have A User Not An Admin or Company
        $this->signIn(create(User::class, ['type' => User::CUSTOMER_TYPE]));

        // When We Hit The card Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');

        // Given We Have A non authenticate User
        auth()->logout();

        // When We Hit The card Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}