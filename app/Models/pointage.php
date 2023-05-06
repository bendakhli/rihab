<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pointage extends Model
{
    use HasFactory;
    protected $fillable=['id','type','employees_id','lat','long','employee_id'];

    public $table='pointages';

         public function Employee(){
            return $this->belongsto('\App\Employee');
         }
}
