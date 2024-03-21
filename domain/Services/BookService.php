<?php

namespace domain\Services;

use App\Models\Book;
use Exception;
use Illuminate\Support\Facades\Validator;

class BookService
{
    protected $book;
    public function __construct()
    {
        $this->book = new Book();
    }
    public function all()
    {
        return $this->book->all();
    }
    public function store($request)
    {
        try {
            $data = $request->all();
            $validation = Validator::make($data, [
                'title' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'year' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(['errors' => $validation->errors()], 422);
            };

            $response = $this->book->create($data);
            return $response;
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function getBookById($bookId)
    {
        try {
            return $this->book->find($bookId);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function updateBookById()
    {
    }
    public function deleteBookById($bookId)
    {
        try {
            $book = $this->book->find($bookId);
            $book->delete();
            return response(["msg" => "Succesfully deleted", "status" => true], 500);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
}
