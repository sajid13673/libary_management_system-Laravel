<?php

namespace domain\Services;

use App\Models\Fine;
use App\Models\Payment;
use Exception;

class PaymentService
{
    protected $payment;
    protected $fine;

    public function __construct(Payment $payment, Fine $fine)
    {
        $this->payment = $payment;
        $this->fine = $fine;
    }

    public function makePayment($request)
    {
        \DB::beginTransaction();
        try {
            $fine = $this->fine->find($request->fine_id);
            if (!$fine) {
                return response()->json(['status' => false, 'message' => 'Fine not found'], 404);
            }

            if ($fine->amount !== $request->amount) {
                return response()->json(['status' => false, 'message' => 'Incorrect amount'], 400);
            }

            if($fine->is_paid) {
                return response()->json(['status' => false, 'message' => 'Payment already made'], 400);
            }

            $this->payment->create($request->all());
            $fine->is_paid = true;
            $fine->save();

            \DB::commit();
            return response()->json(['status' => true, 'message' => 'Payment successfully made'], 200);
        } catch (Exception $e) {
            \DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
