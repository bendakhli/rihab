<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pointage extends Model
{
    use HasFactory;
     protected $fillable=['heur_depart','heur_arriver','empoiloyé_id'];

     public function Users(){
        return $this->belongsto(Users::class);
     }
     
}
