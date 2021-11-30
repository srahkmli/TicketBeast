<?php

namespace Tests\Unit\Billing;

use App\Billing\FakePeymentGateway;
use PHPUnit\Framework\TestCase;

class FakePeymentGatewayTest extends TestCase
{
    /** @test */
    public function charges_with_valid_payment_are_successful()
    {
        $paymentGateway = new FakePeymentGateway;
        $paymentGateway->charge(2500, $paymentGateway->getValidToken());

        $this->assertEquals(2500, $paymentGateway->totalCharges());
    }
}
