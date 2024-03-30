<?php

namespace domain\Services;

use App\Models\Image;
use App\Models\Member;
use App\Traits\ImageManager;

class MemberService
{
    protected $member;
    protected $image;
    use ImageManager;
    public function __construct()
    {
        $this->member = new Member();
        $this->image = new Image();
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
            $member = $this->member->create($data);
            if($file = $request->file('image')){
                $saved_image = $this->uploads($file, "public/uploads");
                $image_data = ["name" => $saved_image['fileName'], "path" => "storage/uploads/"];
                $image = $this->image->create($image_data);
                $member->images()->save($image);
            }
            return response()->json(["status" => true, "msg" => "Successfully created new member"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function get($memberId, $request)
    {
        try {
            $member = $this->member->find($memberId);
            if($request->borrowing){
                $member = $this->member->with('borrowing.book')->find($memberId);
            }

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
            if($file = $request->file('image')){
                $currentImage = $member->images()->first();
                if($currentImage !== null){
                    $this->deleteFile(str_replace("storage","public",$currentImage->path), $currentImage->name); // Deleting the image file
                    $currentImage->delete();
                }
                $saved_image = $this->uploads($file, "public/uploads");
                $image_data = ["name" => $saved_image['fileName'], "path" => "storage/uploads/"];
                $image = $this->image->create($image_data);
                $member->images()->save($image);
            }
            return response()->json(["status" => true, "msg" => "Successfully updated member"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
    public function delete($memberId)
    {
        try {
            $member = $this->member->find($memberId);
            $member->delete();
            return response()->json(["status" => true, "msg" => "Successfully deleted member"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => false, "msg" => $e->getMessage()], 500);
        }
    }
}
