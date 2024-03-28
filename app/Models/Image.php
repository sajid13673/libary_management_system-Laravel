<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "name",
        "path",
        "book_id",
        "member_id",
    ];
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function member(){
        return $this->belongsTo(Member::class);
    }
}
