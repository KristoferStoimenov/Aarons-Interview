<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $statuses = ['Complete', 'Pending', 'Failed', 'Processing'];
    protected $shift_types = ['Day','Night', 'Holiday'];
    
    public function getStatuses()
    {
        return $this->statuses;
    }

    public function getShiftTypes()
    {
        return $this->shift_types;
    }
}
