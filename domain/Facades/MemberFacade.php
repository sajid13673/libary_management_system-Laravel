<?php 
namespace domain\Facades;

use domain\Services\MemberService as ServicesMemberService;
use Illuminate\Support\Facades\Facade;

class MemberFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return ServicesMemberService::class;
    }
}