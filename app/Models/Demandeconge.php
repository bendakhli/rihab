<?php

namespace App\Models;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandeconge extends Model
{
    use HasFactory;
    public function Employee(){
        return $this->hasOne('App\Models\Employee');
     }
}
