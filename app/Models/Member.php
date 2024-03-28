<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "email",
        "address",
        "phone_number",
    ];
    protected $appends = ['path'];
    public function borrowing(){
        return $this->hasMany(Borrowing::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function getPathAttribute()
    {
        $image = $this->images()->where('member_id', $this->id)->first();
        if($image == null){
            return null;
        }
        return asset($image->path.$image->name);
    }
}
