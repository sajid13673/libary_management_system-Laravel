<?php

namespace domain\Services;

use App\Models\Borrowing;
use Carbon\Carbon;
use Exception;

class BorrowingService
{
    protected $borrowing;
    public function __construct()
    {
        $this->borrowing = new Borrowing();
    }
    public function all($request)
    {
        try {
            $products = $this->borrowing->with('book','member')->orderBy('created_at','desc')->paginate($request->per_page);
            return response()->json(["status" => 200, "data" => $products], 200);
        } catch (Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function store($request)
    {
        try {
            $data = $request->all();
            $this->borrowing->create($data);
            return response()->json(["status" => true, "data" => "Succesfully created"], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function get($id)
    {
        try {
            $product = $this->borrowing->find($id);
            return response()->json(["status" => true, "data" => $product], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function update($request, $id)
    {
        try {
            $now = Carbon::now();
            if($request->return_date > $now) {
                return response()->json(["status" => false, "msg" => "Return date cannot be in the future"], 400);
            }
            $borrowing = $this->borrowing->find($id);
            $borrowing->update($request->all());
            return response()->json(["status" => true, "msg" => "Succesfully updated"], 200);
        } catch (Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function delete($id)
    {
        try {
            $borrowing = $this->borrowing->find($id);
            $borrowing->delete();
            return response(["msg" => "Succesfully deleted", "status" => true], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
}
