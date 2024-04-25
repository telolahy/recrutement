<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    public static function listesroles($nomrole){
        if($nomrole=="Super Admin"){
            return Role::get();
        }
        else if($nomrole=="Admin"){
            return DB:: select('select*from roles WHERE nomrole!="Super Admin" and nomrole!="Admin"');
        }

    }
}
