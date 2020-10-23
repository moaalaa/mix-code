<?php

namespace Tests\Feature\Dashboard\Contacts;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Contact;

class ReadContactsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_administrators_cant_read_single_contact()
    {
        $this->readContact(route('dashboard.contacts.show', create(Contact::class)));
    }

    /** @test */
    public function non_authenticate_administrators_cant_read_all_contact()
    {
        $this->readContact(route('dashboard.contacts.index'));
    }

    /** @test */
    public function authenticate_administrators_can_read_single_contact()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $contact = create(Contact::class);

        // When We Hit The Contact Read Endpoint
        $response = $this->getJson(route('dashboard.contacts.show', $contact));
        
        // Then It Should Get The SubContact That Was Created
        $response->assertOk();
        $this->assertEquals($contact->toArray(), $response->json());
    }

    /** @test */
    public function authenticate_administrators_can_read_all_contact()
    {
        // Given We Have An Authenticated Admin
        $this->signInAsAdmin();
        
        $contacts = create(Contact::class, [], 3);

        // When We Hit The Contact Read Endpoint
        $response = $this->getJson(route('dashboard.contacts.index'));
        
        // Then It Should Get The "4" Contacts That Was Created
        $response->assertOk();
        $response->assertSee($contacts->first()->name);
        $response->assertSee($contacts->get(1)->name);
        $response->assertSee($contacts->last()->name);
    }

    protected function readContact($route)
    {
        // $this->withExceptionHandling();

        // Given We Have A Contact Not An Admin
        $this->signIn();

        // When We Hit The Contact Read Endpoint
        $response = $this->getJson($route);
 
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
        // Given We Have A non authenticate Contact
        auth()->logout();

        // When We Hit The Contact Read Endpoint
        $response = $this->getJson($route);
        
        // Then it Should Give An Error un Authorized
        $response->assertRedirect('/login');
        
    }
}