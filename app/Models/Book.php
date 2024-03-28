<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "title",
        "author",
        "publisher",
        "year",
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
        $image = $this->images()->where('book_id', $this->id)->first();
        if($image == null){
            return null;
        }
        return asset($image->path.$image->name);
    }
}
