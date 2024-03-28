<?php 
namespace domain\Facades;

use domain\Services\FineService;
use Illuminate\Support\Facades\Facade;

class FineFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return FineService::class;
    }
}