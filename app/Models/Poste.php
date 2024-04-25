<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Poste extends Model
{
    use HasFactory;
    public static function listespostes($nomrole){
        if($nomrole=="Super Admin"){
            return Poste::get();
        }
        else if($nomrole=="Admin"){
            return DB:: select('select*from postes WHERE nomposte="Chef de Service"');
        }

    }
}
