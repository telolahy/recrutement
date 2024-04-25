<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Region extends Model
{
    use HasFactory;
    public static function getAllRegion(){
    	$result= DB:: select('SELECT*FROM regions');
        return $result;
    }  
}
