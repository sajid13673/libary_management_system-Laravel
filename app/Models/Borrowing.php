<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;
    protected $fillable = [
        "id",
        "member_id",
        "book_id",
        "due_date",
        "status",
        "return_date",
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function fine(){
        return $this->hasOne(Fine::class);
    }
}
