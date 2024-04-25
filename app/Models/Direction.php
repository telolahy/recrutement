<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Direction extends Model
{
    use HasFactory;
    public static function listesDirection($nomrole,$idDirection){
    	 if($nomrole=="Super Admin"){
            return Direction::get();
        }
        else if($nomrole=="Admin"){
            return DB:: select('select*from directions WHERE id=?',[$idDirection]);
        }
    }
}
