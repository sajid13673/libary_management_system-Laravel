<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;
    protected $fillable = [
        "amount",
        "member_id",
        "borrowing_id",
        "days"
    ];

    public function borrowing(){
        return $this->belongsTo(Borrowing::class);
    }
    public function member(){
        return $this->belongsTo(Member::class);
    }
    public function payment() { 
        return $this->hasOne(Payment::class);
    }

}
