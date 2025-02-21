<?php

namespace domain\Services;

use App\Models\Payment;

class PaymentService {
    protected $payment;
    public function __construct() {
        $this->payment = new Payment();
    }
    public function makePayment($request){
        return 'success';
    }
}