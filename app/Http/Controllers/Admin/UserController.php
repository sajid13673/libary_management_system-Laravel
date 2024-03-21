<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\UserFacade;

class UserController extends Controller
{
    public function store(Request $request){
        UserFacade::store($request);
    }
    public function delete($id){
        UserFacade::deleteUserById($id);
    }
}
