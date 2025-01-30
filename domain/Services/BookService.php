<?php

namespace domain\Services;

use App\Models\Book;
use App\Models\Image;
use App\Traits\ImageManager;
use Exception;

class BookService
{
    protected $book;
    protected $image;
    use ImageManager;
    public function __construct()
    {
        $this->book = new Book();
        $this->image = new Image();
    }
    public function all($request)
    {
        try {
            $books = $this->book->paginate($request->per_page);
            return response()->json(["status" => true, "data" => $books], 200);
        } catch (Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function store($request)
    {
        try {
            $data = $request->all();
            $book = $this->book->create($data);
            if($file = $request->file('image')){
                $saved_image = $this->uploads($file, "public/uploads");
                $image_data = ["name" => $saved_image['fileName'], "path" => "storage/uploads/"];
                $image = $this->image->create($image_data);
                $book->images()->save($image);
            }
            return response()->json(["status" => true, "message" => "Book created successfully"], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function get($bookId)
    {
        try {
            $book = $this->book->find($bookId);
            return response()->json(["status" => true, "data" => $book], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function updateBookById($request, $id)
    {
        try {
            $book = $this->book->find($id);
            $book->update($request->all());
            if($file = $request->file('image')){
                $currentImage = $book->images()->first();
                if($currentImage !== null){
                    $this->deleteFile(str_replace("storage","public",$currentImage->path), $currentImage->name); // Deleting the image file
                    $currentImage->delete();
                }
                $saved_image = $this->uploads($file, "public/uploads");
                $image_data = ["name" => $saved_image['fileName'], "path" => "storage/uploads/"];
                $image = $this->image->create($image_data);
                $book->images()->save($image);
            }
            return response()->json(["status" => true, "msg" => "Succesfully updated"], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function delete($bookId)
    {
        try {
            $book = $this->book->find($bookId);
            $book->delete();
            return response(["msg" => "Succesfully deleted", "status" => true], 200);
        } catch (Exception $e) {
            return response(["msg" => $e->getMessage(), "status" => false], 500);
        }
    }
    public function getBookStats(){
        try {
            $totalBooks = $this->book->count();
            $issuedBooks = $this->book->whereHas('borrowing', function($query) {
                $query->where('status', true);
            })->count();
            $availableBooks = $totalBooks - $issuedBooks;
            $overdueBooks = $this->book->whereHas('borrowing', function($query) {
                $query->where('status', true)->where('due_date', '>', now());
            })->with('borrowing')->count();
            return response()->json(["status" => true, "data" => ['totalBooks' => $totalBooks, 'issuedBooks' => $issuedBooks, 'availableBooks' => $availableBooks, 'overdueBooks' => $overdueBooks]], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
}
