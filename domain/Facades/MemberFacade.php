<?php 
namespace domain\Facades;

use domain\Services\MemberService\MemberService;
use Illuminate\Support\Facades\Facade;

class MemberFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return MemberService::class;
    }
}