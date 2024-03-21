<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use domain\Facades\UserFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function userLogin(request $request){
        $input = $request->all();
        $validation = Validator::make($input,[
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if($validation->fails()){
            return response()->json(['error' => $validation->errors()->all()], 422);
        }
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])){
            $authenticated_user = Auth::user();
            $user = User::find($authenticated_user->id);
            $token = $user->createToken('myApp')->accessToken;
            return response()->json(['token' => $token]);
        };
        $authenticated_user = Auth::user();
        return ['request' => $input, 'user'=>$authenticated_user];
    }
    public function register(Request $request){
        return UserFacade::store($request);
    }
}
