<?php

namespace Tests\Feature;

use App\Billing\FakePeymentGateway;
use App\Billing\PaymentGateway;
use App\Models\Concert;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseTicketTest extends TestCase
{

    use DatabaseMigrations;
    use RefreshDatabase;

    /** @test */
    public function customer_can_purchase_concert_ticket()
    {
        $paymentGateway = new FakePeymentGateway();
        $this->app->instance(PaymentGateway::class, $paymentGateway);

        $this->withoutExceptionHandling();
        $concert = Concert::factory()->create(['ticket_price' => 3250,]);

        $response = $this->post('/concerts/{$concert->id}/orders', [
            'email' => 'john@example.com',
            'ticket_quantity' => 3,
            'ticket_price' => 3250,
            'payment_gateway' => $paymentGateway->getValidToken(),
        ]);

        $response->assertStatus(201);

        $this->assertEquals(9750, $paymentGateway->totalCharges());

        $orders = $concert->orders()->where('email', 'john@gmail.com')->first();
        $this->assertNotNull($orders);
        $this->assertEquals(3, $orders->tickets->count());
    }
}
