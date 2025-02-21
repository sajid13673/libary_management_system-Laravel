<?php 
namespace domain\Facades;

use domain\Services\PaymentService;
use Illuminate\Support\Facades\Facade;

class PaymentFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return PaymentService::class;
    }
}