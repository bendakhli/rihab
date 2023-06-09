<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory;
    protected $fillable = ['start_date', 'duration', 'reason', 'employee_id','status'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee');
    }
}
