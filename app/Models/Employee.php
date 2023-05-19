<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name', 'lastname', 'post','department'];
    public $table='employees';

   public function Pointages(){
    return $this->hasMany('App\Models\Pointage');
   }

   public function user(){
    return $this->hasOne('App\Models\User');
 }
 public function leaves(){
    return $this->hasMany('App\Models\LeaveRequest');
   }
}
