<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use MixCode\Contact;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function non_authenticate_and_authenticate_users_can_send_contact_contact()
    {
        $this->withExceptionHandling();
        
        // Given We Have A Contact Message and authenticate user
        $this->signIn();
        
        // When We Hit The Contact Store Endpoint
        $this->createNewContact()->assertStatus(Response::HTTP_CREATED);

        // Then Contacts Count Should Be 1
        $this->assertEquals(1, Contact::count());

        // Given We Have A non authenticate Contact
        auth()->logout();

        // When We Hit The Contact Store Endpoint
        $this->createNewContact()->assertStatus(Response::HTTP_CREATED);
        
        // Then Contacts Count Should Be 2
        $this->assertEquals(2, Contact::count());
    }

    /** @test */
    public function contact_required_a_valid_name()
    {
        $this->createNewContact(['name' => null])
            ->assertJsonValidationErrors('name')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    public function contact_required_a_valid_email()
    {
        $this->createNewContact(['email' => null])
            ->assertJsonValidationErrors('email')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->createNewContact(['email' => 'not-valid-email'])
            ->assertJsonValidationErrors('email')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    
    /** @test */
    public function contact_required_a_valid_message()
    {
        $this->createNewContact(['message' => null])
            ->assertJsonValidationErrors('message')
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    
    protected function createNewContact($overrides = [])
    {
        $this->withExceptionHandling();

        // Given We Have a Contact
        $contact = make(Contact::class, $overrides);
        
        // When We Hit The Contact API Store Endpoint
        // Then It Should Get The Contact That Was Created
        return $this->postJson(route('api.contacts.store'), $contact->toArray());
    }
}