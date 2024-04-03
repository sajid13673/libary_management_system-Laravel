<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use domain\Facades\BorrowingFacade;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index(Request $request){
        return BorrowingFacade::all($request);
    }
    public function store(Request $request){
        return BorrowingFacade::store($request);
    }
    public function show($id){
        return BorrowingFacade::get($id);
    }
    public function update(Request $request, string $id){
        return BorrowingFacade::update($request, $id);
    }
    public function destroy($id){
        return BorrowingFacade::delete($id);
    }
}
