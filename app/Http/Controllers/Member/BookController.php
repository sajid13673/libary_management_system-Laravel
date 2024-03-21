<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use domain\Facades\BookFacade;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return BookFacade::all();
    }
    public function get($id){
        return BookFacade::getBookById($id);
    }
}
