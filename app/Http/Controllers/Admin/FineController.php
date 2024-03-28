<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use domain\Facades\FineFacade;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index(){
        return FineFacade::all();
    }
    public function store(Request $request){
        return FineFacade::store($request);
    }
    public function show($id){
        return FineFacade::get($id);
    }
    public function update(Request $request, string $id){
        return FineFacade::update($request, $id);
    }
    public function destroy($id){
        return FineFacade::delete($id);
    }
}
