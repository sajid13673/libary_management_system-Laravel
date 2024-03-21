<?php
namespace domain\Facades;

use domain\Services\BookService;
use Illuminate\Support\Facades\Facade;

class BookFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return BookService::class;
    }
}