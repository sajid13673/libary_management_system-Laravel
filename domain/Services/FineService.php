<?php

namespace domain\Services;

use App\Models\Fine;

class FineService
{
    protected $fine;
    public function __construct()
    {
        $this->fine = new Fine();
    }
    public function all($request)
    {
        try {
            $type = $request->type ? $request->type : 'all';
            $per_page = $request->per_page ? $request->per_page : 10;
            $query = $this->fine->with(['member', 'borrowing']);
            if ($type !== 'all') {
                $query->where('is_paid', $type === 'paid' ? true : false);
            }
            $fines = $query->paginate($per_page);
            return response()->json(["status" => true, "data" => $fines], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function store($request)
    {
        try {
            $data = $request->all();
            $this->fine->create($data);
            return response()->json(["status" => true, "msg" => "Successfully created"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function get($fineId)
    {
        try {
            $fine = $this->fine->with(['member', 'borrowing.book'])->find($fineId);
            return response()->json(["status" => true, "data" => $fine], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function update($id, $request)
    {
        try {
            $fine = $this->fine->find($id);
            $fine->update($request->all());
            return response()->json(["status" => true, "msg" => "Successfully updated"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function delete($fineId)
    {
        try {
            $fine = $this->fine->find($fineId);
            $fine->delete();
            return response()->json(["status" => true, "msg" => "Successfully deleted"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
}
