<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employé extends Model
{
    use HasFactory;

   public function pointage(){
    return $this->hasMany(pointage::class);
   }
   public function conge(){
    return $this->hasMany(conge::class);
   }
}
