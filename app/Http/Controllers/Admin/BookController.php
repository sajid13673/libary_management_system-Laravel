<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookPostRequest;
use App\Http\Requests\BookPutRequest;
use Illuminate\Http\Request;
use domain\Facades\BookFacade;

class BookController extends Controller
{
    public function index(Request $request){
        return BookFacade::all($request);
    }
    public function store(BookPostRequest $request){
        return BookFacade::store($request);
    }
    public function update(BookPutRequest $request, string $id){
        return BookFacade::updateBookById($request, $id);
    }
    public function destroy($id){
        return BookFacade::delete($id);
    }
    public function show($id){
        return BookFacade::get($id);
    }
    public function getBookStats(){
        return BookFacade::getBookStats();
    }
}
