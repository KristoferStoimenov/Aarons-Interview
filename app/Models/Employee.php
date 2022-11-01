<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function shift_type(){
        return $this->belongsTo(ShiftType::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

}
