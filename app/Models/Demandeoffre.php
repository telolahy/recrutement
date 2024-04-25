<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Demandeoffre extends Model
{
	protected $fillable = ['nom','prenom','nomEnquete','poste_id','direction_id'];
	protected $table = 'demandeoffres';
    use HasFactory;

    public static function getListeDemandeOffre(){
    	$result= DB:: select('SELECT*FROM listesdemandeajoutoffre');
    	return $result;
    }
}
