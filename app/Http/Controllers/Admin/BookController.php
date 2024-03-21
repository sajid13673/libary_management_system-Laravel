<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use domain\Facades\BookFacade;

class BookController extends Controller
{
    public function store(Request $request){
        return BookFacade::store($request);
    }
    public function update($id, Request $request){
        BookFacade::updateBookById($id, $request);
    }
    public function delete($id){
        BookFacade::deleteBookById($id);
    }
    public function get($id){
        BookFacade::getBookById($id);
    }
}
