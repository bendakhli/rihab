<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'lastname', 'post','department'];
    public $table='employees';

   public function Pointages(){
    return $this->hasMany('\App\Employee');
   }
}
