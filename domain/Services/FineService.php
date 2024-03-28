<?php

namespace domain\Services;

use App\Models\Member;

class FineService
{
    protected $member;
    public function __construct()
    {
        $this->member = new Member();
    }
    public function all()
    {
        try {
            $members = $this->member->all();
            return response()->json(["status" => true, "data" => $members], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function store($request)
    {
        try {
            $data = $request->all();
            $this->member->create($data);
            return response()->json(["status" => true, "msg" => "Successfully created"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function get($memberId)
    {
        try {
            $member = $this->member->find($memberId);
            return response()->json(["status" => true, "data" => $member], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function update($id, $request)
    {
        try {
            $member = $this->member->find($id);
            $member->update($request->all());
            return response()->json(["status" => true, "msg" => "Successfully updated"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function delete($memberId)
    {
        try {
            $member = $this->member->find($memberId);
            $member->delete();
            return response()->json(["status" => true, "msg" => "Successfully deleted"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
}
