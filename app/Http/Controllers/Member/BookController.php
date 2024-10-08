<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use domain\Facades\BookFacade;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request){
        return BookFacade::all($request);
    }
}
