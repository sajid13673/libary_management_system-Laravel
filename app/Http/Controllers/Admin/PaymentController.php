<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentPostRequest;
use App\Models\Payment;
use domain\Facades\PaymentFacade;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function makePayment(PaymentPostRequest $request) {
        return PaymentFacade::makePayment($request);
    }
}
