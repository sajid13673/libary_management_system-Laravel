<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "address",
        "phone_number",
    ];
    protected $appends = ['path','activeBorrowings'];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function borrowing(){
        return $this->hasMany(Borrowing::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function getPathAttribute()
    {
        $image = $this->images()->where('member_id', $this->id)->first();
        if($image == false){
            return null;
        }
        return asset($image->path.$image->name);
    }
    public function getActiveBorrowingsAttribute(){
        $count = $this->borrowing()->where('status', 1)->count();
        return $count > 0 ? true : false;
    }

}
