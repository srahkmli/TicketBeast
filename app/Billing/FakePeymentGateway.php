<?php

namespace App\Billing;


class FakePeymentGateway implements PaymentGateway
{
    protected $charges;

    public function __construct()
    {
        $this->charges = collect();
    }

    public function getValidToken(): string
    {
        return 'valid-token';
    }

    public function charge($amount, $token)
    {
        $this->charges->push($amount);;
    }

    public function totalCharges()
    {
        return $this->charges->sum();
    }

}
