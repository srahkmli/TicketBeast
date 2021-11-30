<?php

namespace Tests\Unit;

use App\Models\Concert;
use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;

class ConcertTest extends TestCase
{

/** @test */

    public function can_get_formatted_date()
    {
         $concert = Concert::factory()->make([
            'date' => Carbon::parse('December 13,2016 8:00pm'),
        ]);
        $this->assertEquals('December 13,2016', $concert->formatted_date);
    }

 public function can_get_formatted_started_time()
    {
         $concert = Concert::factory()->make([
            'date' => Carbon::parse('December 13,2016 17:00:00'),
        ]);
        $this->assertEquals('5:00pm', $concert->formatted_started_time);
    }
 public function can_get_ticket_price_in_dollors()
    {
         $concert = Concert::factory()->make([
            'ticket_price' => 3250,
        ]);
        $this->assertEquals('32.50', $concert->formatted_ticketprice_in_dollors);
    }
    function concerts_with_a_published_at_date_are_published()
{
    $publishedConcertA = Concert::factory()->create(['published_at' => Carbon::parse('-1 week')]);
    $publishedConcertB = Concert::factory()->create(['published_at' => Carbon::parse('-1 week')]);
    $unpublishedConcert = Concert::factory()->create(['published_at' =>null]);

    $publishedConcerts = Concert::published()->get();

    $this->assertTrue($publishedConcerts->contains($publishedConcertA));
    $this->assertTrue($publishedConcerts->contains($publishedConcertB));
    $this->assertFalse($publishedConcerts->contains($unpublishedConcert));
}

}