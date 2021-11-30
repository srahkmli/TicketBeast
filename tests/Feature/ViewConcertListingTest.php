<?php

namespace Tests\Feature;

use App\Models\Concert;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewConcertListingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    public function user_can_view_the_consert_listing()
    {
        $this->withoutExceptionHandling();

        $concert = Concert::factory()->published()->create([
            //$concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13,2016 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555.',

        ]);
//view the list
        $response = $this->get('/concerts/' . $concert->id);
        $response->assertStatus(200);

        //  $response->assertViewHas('concerts', $concert);
        $response->assertSeeText('The Red Chord');
        $response->assertSeeText('with Animosity and Lethargy');
        $response->assertValid('December 13, 2016');
        $response->assertValid('8:00pm');
        $response->assertValid('32.50');
        $response->assertSeeText('The Mosh Pit');
        $response->assertSeeText('123 Example Lane');
        $response->assertSeeText('Laraville, ON 17916');
        $response->assertSeeText('For tickets, call (555) 555-5555.');

    }

    /** @test */

    public function user_cant_view_the_unpublished_concert()
    {
        $concert = Concert::factory()->unpublished()->create();


//view the list
        $response = $this->get('/concerts/' . $concert->id);

        $response->assertStatus(404);

    }
}
