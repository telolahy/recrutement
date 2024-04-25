<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccesOffre extends Model
{
    use HasFactory;

    protected $fillable=[ 'offre_id' ,
    'administrateur_id' , // Remplacez 1 par l'administrateur_id correspondant
    'etat'];
    public static function insertAccesOffres($offre_id,$administrateur_id,$etat){
    	$result= DB:: insert('INSERT INTO accesoffres VALUES(null,?,?,?)',[$offre_id,$administrateur_id,$etat]);
    	return $result;
    }
    public static function listesAdminAccesOffres($idOffre){
    	$sql= DB:: select('SELECT ac.id as idacces,a.id as idAdministrateurs,a.nom,a.prenom,ac.offre_id,r.nomrole,p.nomposte,ac.etat from accesoffres ac join administrateurs a on ac.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id where ac.offre_id=? and ac.etat="Active"',[$idOffre]);
        return $sql;
    }
    // public function updateAccesOffre($idOffres,$idAdmin){
    // 	$sql= DB:: update('UPDATE accesoffres SET administrateur_id=? WHERE id= ?',[$idAdmin],$idOffres);
    //     return $sql;
    // }
    public static function updateEtatAccesOffre($idOffres,$idAdmin,$etat){
        $sql= DB:: update('UPDATE accesoffres SET etat=? WHERE administrateur_id= ? and offre_id= ?',[$etat,$idAdmin,$idOffres]);
        return $sql;
    }
    public static function getAllAccesAdmin($idOffres){
        $sql= DB:: select('SELECT ac.id as idacces,a.id as idAdministrateurs,a.nom,a.prenom,ac.offre_id,r.nomrole,p.nomposte,ac.etat from accesoffres ac join administrateurs a on ac.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id where ac.offre_id=?',[$idOffres]);
        return $sql;
    }
    public static function getAccesOffre($idOffres,$idAdmin){
         $sql= DB:: select('SELECT ac.id as idacces,a.id as idAdministrateurs,a.nom,a.prenom,ac.offre_id,r.nomrole,p.nomposte,ac.etat from accesoffres ac join administrateurs a on ac.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id where ac.offre_id=? and ac.administrateur_id=?',[$idOffres,$idAdmin]);
        return $sql;
    }
    public static function desactivationOffreAdmin($idOffres,$idAdmin){
         $sql= DB:: select('SELECT ac.id as idacces,a.id as idAdministrateurs,a.nom,a.prenom,ac.offre_id,r.nomrole,p.nomposte,ac.etat from accesoffres ac join administrateurs a on ac.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id where ac.offre_id=? and ac.administrateur_id!=?',[$idOffres,$idAdmin]);
        return $sql;
    }
}
