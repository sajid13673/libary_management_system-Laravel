<?php 
namespace domain\Facades;

use domain\Services\BorrowingService;
use Illuminate\Support\Facades\Facade;

class BorrowingFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return BorrowingService::class;
    }
}