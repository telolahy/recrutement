<?php

namespace App\Models;

use App\Models\Offre;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visiteur extends Model
{
    use HasFactory;
    protected $table='visiteurs'; 
    
    protected $fillable=[
        'offre_id',
        'nombreVisiteurs',
    ];

    public static function offres()
    {
        return $this->belongsTo(Offre::class);
    }

    public static function insertVisiteur($idOffres,$nombreVisiteurs){
    	$result= DB:: insert('INSERT INTO visiteurs VALUES(null,?,?)',[$idOffres,$nombreVisiteurs]);
    	return $result;
    }
    public static function updateNombreVissiteur($idOffres,$nombreVisiteurs){
    	$sql= DB:: update('UPDATE visiteurs SET nombreVisiteurs=? WHERE offre_id= ?',[$nombreVisiteurs,$idOffres]);
        return $sql;
    }
    public static function getNombreVisiteurs($idOffres){
    	 $sql= DB:: select('SELECT nombreVisiteurs as nombre from visiteurs WHERE offre_id=?',[$idOffres]);
        return $sql;
    } 
    
}