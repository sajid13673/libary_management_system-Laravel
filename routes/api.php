<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get("profile", [UserController::class, "profile"]);
    Route::get("logout", [UserController::class, "logout"]);
    Route::resource('member', MemberController::class);
    Route::resource('book', AdminBookController::class);
    Route::resource('borrowing',BorrowingController::class);
});

Route::post('login', [UserController::class, 'login'],);
// Route::post('register', [UserController::class, 'register'],);

