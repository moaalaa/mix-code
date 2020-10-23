<?php

namespace Tests\Feature\Site;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use MixCode\Contact;

class CreateContactsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_and_authenticate_users_can_send_contact_contact()
    {
        $this->withExceptionHandling();
        
        // Given We Have A Contact Message and authenticate user
        $this->signIn();
        
        // When We Hit The Contact Store Endpoint
        $this->createNewContact();
        
        // Then Contacts Count Should Be 1
        $this->assertEquals(1, Contact::count());

        // Given We Have A non authenticate Contact
        auth()->logout();

        // When We Hit The Contact Store Endpoint
        $this->createNewContact();
        
        // Then Contacts Count Should Be 2
        $this->assertEquals(2, Contact::count());

    }

    /** @test */
    public function contact_required_a_valid_name()
    {
        $this->createNewContact(['name' => null])->assertSessionHasErrors('name');
    }

    /** @test */
    public function contact_required_a_valid_email()
    {
        $this->createNewContact(['email' => null])->assertSessionHasErrors('email');
        $this->createNewContact(['email' => 'not-valid-email'])->assertSessionHasErrors('email');
    }
    
    /** @test */
    public function contact_required_a_valid_message()
    {
        $this->createNewContact(['message' => null])->assertSessionHasErrors('message');
    }
    
    protected function createNewContact($overrides = [])
    {
        $this->withExceptionHandling();

        // Given We Have a Contact
        $contact = make(Contact::class, $overrides);
        
        // When We Hit The Contact Store Endpoint
        return $this->post(route('contacts.store'), $contact->toArray());
    }
}