<?php

namespace App\Http\Controllers;

use App\Billing\PaymentGateway;
use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertOrderController extends Controller
{

    protected $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function store(Request $request, $concertId)
    {
        $concert = Concert::find($concertId);
        $amount = $request->get('ticket_price') * $request->get('ticket_quantity');
        $this->paymentGateway->charge($amount, $request->get('payment_gateway'));

        return response()->json([], 201);
    }
}
