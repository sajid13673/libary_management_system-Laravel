<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberPostRequest;
use App\Http\Requests\MemberPutRequest;
use Illuminate\Http\Request;
use domain\Facades\MemberFacade;

class MemberController extends Controller
{
    public function index(Request $request){
        return MemberFacade::all( $request);
    }
    public function store(MemberPostRequest $request){
        return MemberFacade::store($request);
    }
    public function update(MemberPutRequest $request, string $id){
        return MemberFacade::update($id, $request);
    }
    public function destroy($id){
        return MemberFacade::delete($id);
    }
    public function show($id, Request $request){
        return MemberFacade::get($id, $request);
    }
}
