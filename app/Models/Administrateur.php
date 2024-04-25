<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class Administrateur extends Authenticatable
{
	//protected $fillable = ['nom','prenom','email','password','role_id','poste_id','poste_id','direction_id','status'];
	//protected $table = 'administrateurs';
    use HasApiTokens, HasFactory, Notifiable;

     public static function insertAdministrateur($nom,$prenom,$email,$password,$idRole,$idPoste,$idDirection,$status){
    	$result= DB:: insert('INSERT INTO administrateurs VALUES(null,?,?,?,?,?,?,?,?)',[$nom,$prenom,$email,$password,$idRole,$idPoste,$idDirection,$status]);
    	return $result;
    }
    public static function getRoleAdmin($idAdmin){
    	$result= DB:: select('SELECT*from administrateurs a join roles r on a.role_id=r.id join postes p on a.poste_id=p.id WHERE a.id = ?',[$idAdmin]);
    	return $result;
    }
    public static function listesComptePagination($limit, $offset,$nomRole){

        if($nomRole=="Super Admin"){

            $sql = DB::select('SELECT a.id as idAdmin, a.nom, a.prenom, a.email, a.password, a.status, r.nomrole, a.role_id, r.id
                                FROM administrateurs a
                                JOIN roles r ON a.role_id = r.id
                                ORDER BY a.id DESC
                                LIMIT ? OFFSET ?', [$limit, $offset]);
        }else{

            $sql = DB::select('SELECT a.id as idAdmin, a.nom, a.prenom, a.email, a.password, a.status, r.nomrole, a.role_id, r.id
                FROM administrateurs a
                JOIN roles r ON a.role_id = r.id AND r.nomrole != "Super Admin" 
                JOIN directions d ON d.id = a.direction_id
                ORDER BY a.id DESC
                LIMIT ? OFFSET ?', [$limit, $offset]);
        }
        return $sql;
    }
    public static function countAdmin(){
        $result= DB:: select('SELECT count(a.id) as isa from administrateurs a');
        return $result;
    }
    public static function getListesComptes(){
    	$result= DB:: select('SELECT a.id as idAdmin,a.nom,a.prenom,a.email,a.password,a.status,r.nomrole,a.role_id,r.id from administrateurs a join roles r on a.role_id=r.id');
    	return $result;
    }
     public static function updateAdmin($status,$id){
        $result= DB:: update('UPDATE administrateurs SET status=? WHERE id= ?',[$status,$id]);
        return $result;
    }
    public static function getFicheAdmin($id){
        $result= DB:: select('SELECT*FROM administrateurs a join roles r on a.role_id=r.id join postes p on a.poste_id=p.id join directions d on a.direction_id=d.id WHERE a.id=?',[$id]);
        return $result;
    }
    public static function accesOffres($idAdmin,$idDirection,$nomrole){
        if($nomrole=="Super Admin"){
            return DB::select('SELECT a.id as idAdmin,a.nom,a.prenom,a.direction_id,r.id as idroles,r.nomrole,p.id as idposte,p.nomposte,di.id as idDirection,di.nomDirection FROM administrateurs a join roles r on a.role_id=r.id join postes p on a.poste_id=p.id join directions di on a.direction_id=di.id WHERE a.direction_id=? AND r.nomrole!="Super Admin" order by r.id',[$idDirection]);
        }
        if($nomrole=="Admin"){
            return DB::select('SELECT a.id as idAdmin,a.nom,a.prenom,a.direction_id,r.id as idroles,r.nomrole,p.id as idposte,p.nomposte,di.id as idDirection,di.nomDirection
FROM administrateurs a join roles r on a.role_id=r.id join postes p on a.poste_id=p.id join directions di on a.direction_id=di.id
WHERE a.direction_id=? AND a.id!=? and r.nomrole!="Super Admin" order by r.id',[$idDirection,$idAdmin]);
        }
        if($nomrole=="Collaborateurs"){
            return DB::select('SELECT a.id as idAdmin,a.nom,a.prenom,a.direction_id,r.id as idroles,r.nomrole,p.id as idposte,p.nomposte,di.id as idDirection,di.nomDirection
FROM administrateurs a join roles r on a.role_id=r.id join postes p on a.poste_id=p.id join directions di on a.direction_id=di.id
WHERE a.direction_id=? AND a.id!=? and r.nomrole="Collaborateurs" order by r.id',[$idDirection,$idAdmin]);
        }
    }
    public static function getRoleAdminCreerOffre($idOffre){
        $sql=DB::select('SELECT a.id as idAdmin,r.nomrole,di.id as idDirection from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id join directions di on a.direction_id=di.id WHERE o.id=?',[$idOffre]);
        return $sql;
    }

}
