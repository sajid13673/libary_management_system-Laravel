<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\MemberFacade;

class MemberController extends Controller
{
    public function store(Request $request){
        MemberFacade::store($request);
    }
    public function update($id, Request $request){
        MemberFacade::update($id, $request);
    }
    public function delete($id){
        MemberFacade::delete($id);
    }
}
