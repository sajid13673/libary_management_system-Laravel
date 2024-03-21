<?php 

namespace domain\Services\MemberService;
use Illuminate\Support\Facades\Validator;
use app\Models\Member;

class MemberService{
    protected $member;
    public function __construct(){
        $this->member = new Member();
    }
    public function getAllMembers(){

    }
    public function store($request){
        $data = $request->all();
        $validation = Validator::make($data,[
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'address' => 'required',
            'status' => 'required',
        ]);
        if($validation->fails()){
            return response()->json(['errors' => $validation->errors()],422);
        };

        $response = $this->member->create($data);
        return $response;
    }
    public function getMemberById($memberId){
        return $this->member->find($memberId);
    }
    public function updateMemberById(){

    }
    public function deleteMemberById($memberId){
        $member = $this->member->find($memberId);
        $member->delete();
    }
    
}