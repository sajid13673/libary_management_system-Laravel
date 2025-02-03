<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Member\BookController as MemberBookController;
use App\Http\Controllers\Admin\BorrowingController;
use App\Http\Controllers\Admin\FineController;
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
    Route::get("logout", [UserController::class, "logout"]);
    Route::resource('member', MemberController::class)->middleware(['scope:manage-members']);
    Route::resource('borrowing',BorrowingController::class)->middleware(['scope:manage-borrowings']);
    Route::get('member_book',[MemberBookController::class, "index"])->middleware(['scope:read-books, manage-books']);
    Route::get('profile', [UserController::class, 'profile']);
    Route::resource('fine',FineController::class)->middleware(['scope:manage-fines']);
    Route::name('book')->prefix('book')->middleware(['scope:manage-books'])->group(function(){
        Route::resource('/', AdminBookController::class);
        Route::get('/stats', [AdminBookController::class, 'getBookStats']);
    });
});

Route::post('login', [UserController::class, 'login'],);
Route::post('register', [UserController::class, 'register'],);
