<?php

namespace domain\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;


class UserService
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function store($request)
    {
        try {
            $data = $request->all();
            $validation = Validator::make($data, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(['errors' => $validation->errors()], 422);
            };

            $response = $this->user->create($data);
            return $response;
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function getUserById($id)
    {
        try {
            return $this->user->find($id);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function delete($id)
    {
        try {
            $user = $this->user->find($id);
            $user->delete();
            return response(["msg" => "Successfully deleted", "status" => true], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
}
