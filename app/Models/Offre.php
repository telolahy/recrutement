<?php

namespace App\Models;

use App\Models\Visiteur;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomEnquete',
        'detailsEnquete',
        'dateDebut',
        'statusOffres',
        'dateLimite',
        'administrateur_id',
        'formulaire',
    ];

    public static function visiteurs()
    {
        return $this->hasMany(Visiteur::class);
    }

    public static function insertOffre($nomEnquete,$detailsEnquete,$dateLimite,$administrateur_id,$formulaire,$statusOffres){
    	$result= DB:: insert('INSERT INTO offres VALUES(null,?,?,now(),?,?,?,?)',[$nomEnquete,$detailsEnquete,$dateLimite,$administrateur_id,$formulaire,$statusOffres]);
    	return $result;
    }
    public static function countOffrePublie(){
         $result= DB:: select('SELECT count(id) as nombreOffre FROM offres WHERE statusOffres="publie"');
        return $result;
    }
    public static function getAllOffre($limit,$page){
        $lim=$limit;
        $ofs=$page*$limit;
        $ligne=$ofs-$limit;
    	$result= DB:: select("SELECT*, CASE WHEN now()>o.dateLimite THEN 'cette offre a atteint la date limite' WHEN now()<o.dateLimite THEN 'Offre postule' END AS statusDateOffre FROM offres o WHERE o.statusOffres='publie' order by o.id DESC LIMIT ? offset ?",[$lim,$ligne]);
    	return $result;
    }

    public static function getnow(){
    	$result= DB:: select('select now() as datedebut');
    	return $result;
    }
    public static function getOffreById($idOffre){
    	$result= DB:: select('SELECT*FROM offres o WHERE o.id =?',[$idOffre]);
    	return $result;
    }
    public static function detailsOffres($idOffre){
        $result= DB:: select("SELECT*, CASE WHEN now()>o.dateLimite THEN 'cette offre a atteint la date limite' WHEN now()<o.dateLimite THEN 'Postule' END AS statusDateOffre FROM offres o WHERE o.id = ?",[$idOffre]);
        return $result;
    }
    public static function getFormulaireOffre($idOffre){
    	$result= DB:: select('SELECT formulaire from offres  WHERE id = ?',[$idOffre]);
    	return $result;
    }
    public static function getNomEnquete($idOffres){
        $result= DB:: select('SELECT nomEnquete from offres  WHERE id = ?',[$idOffres]);
        return $result;
    }

//     public function getListesOffres($nomrole,$idDirection,$idAdmin){
//         if($nomrole=="Super Admin"){
//             return DB:: select('SELECT o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
// a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,di.id as idDirection,di.nomDirection
// from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id
// join postes p on a.poste_id=p.id join directions di on a.direction_id=di.id WHERE a.direction_id=? AND(a.id=? OR r.nomrole!="Super Admin")',[$idDirection,$idAdmin]);
//         }
//         if($nomrole=="Admin"){
//              return DB:: select('SELECT  o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
// a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,d.id as idDirection,d.nomDirection
// from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id
// join postes p on a.poste_id=p.id join directions d on a.direction_id=d.id WHERE r.id>=2 and a.direction_id=? AND(a.id=? OR r.nomrole!="Admin")',[$idDirection,$idAdmin]);
//         }
//         if($nomrole=="Collaborateurs"){
//              return DB:: select('SELECT o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
// a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,d.id as idDirection,d.nomDirection
// from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id
// join directions d on a.direction_id=d.id WHERE a.id=? and a.direction_id=? and r.nomrole="Collaborateurs"',[$idAdmin,$idDirection]);
//         }
//     }
    public static function getListesOffres($nomrole,$idDirection,$idAdmin,$limit,$page){
        $lim=$limit;
        $ofs=$page*$limit;
        $ligne=$ofs-$limit;


        if($nomrole=="Super Admin"){
            return DB:: select('SELECT o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
     a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,di.id as idDirection,di.nomDirection from offres o
     join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id join directions di on a.direction_id=di.id WHERE a.direction_id=?  ORDER BY o.id DESC LIMIT ? OFFSET ?', [$idDirection, $lim, $ligne]);
        }elseif($nomrole=="Admin"){
            return DB:: select('SELECT  o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,d.id as idDirection,d.nomDirection
from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id
join postes p on a.poste_id=p.id join directions d on a.direction_id=d.id left join accesoffres ac on ac.offre_id=o.id
WHERE  a.direction_id=? AND(a.id=? OR r.id > 2 OR ac.administrateur_id=? and ac.etat="Active") ORDER BY o.id DESC
         LIMIT ? OFFSET ?', [$idDirection,$idDirection,$idAdmin, $lim, $ligne]);
      } else{

            return DB:: select('SELECT o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,d.id as idDirection,d.nomDirection
from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id
join directions d on a.direction_id=d.id left join accesoffres ac on ac.offre_id=o.id WHERE a.direction_id=?
and (a.id=? OR ac.administrateur_id=? and ac.etat="Active") ORDER BY o.id DESC
         LIMIT ? OFFSET ?', [$idDirection,$idDirection,$idAdmin, $lim, $ligne]);
        }
    }

    public static function countListesOffres($nomrole,$idDirection,$idAdmin){
        if($nomrole=="Super Admin"){
            return DB:: select('SELECT o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
     a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,di.id as idDirection,di.nomDirection from offres o
     join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id join directions di on a.direction_id=di.id WHERE a.direction_id=? group by o.id',[$idDirection]);
        }
        if($nomrole=="Admin"){
            return DB:: select('SELECT  o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,d.id as idDirection,d.nomDirection
from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id
join postes p on a.poste_id=p.id join directions d on a.direction_id=d.id left join accesoffres ac on ac.offre_id=o.id
WHERE  a.direction_id=? AND(a.id=? OR r.id>2 OR ac.administrateur_id=? and ac.etat="Active") group by o.id',[$idDirection,$idAdmin,$idAdmin]);
        }
        if($nomrole=="Collaborateurs"){
            return DB:: select('SELECT o.id as idOffres,o.nomEnquete,o.detailsEnquete,o.dateDebut,o.dateLimite,o.administrateur_id,o.statusOffres,
a.nom,a.prenom,a.id as idAdmin,r.id as idrole,r.nomrole,p.id as idPoste,p.nomposte,d.id as idDirection,d.nomDirection
from offres o join administrateurs a on o.administrateur_id=a.id join roles r on a.role_id=r.id join postes p on a.poste_id=p.id
join directions d on a.direction_id=d.id left join accesoffres ac on ac.offre_id=o.id WHERE a.direction_id=?
and (a.id=? OR ac.administrateur_id=? and ac.etat="Active") group by o.id',[$idDirection,$idAdmin,$idAdmin]);
        }
    }
     public static function updateOffre($nomEnquete,$detailsEnquete,$dateLimite,$formulaire,$id){
        $result= DB:: update('UPDATE offres SET nomEnquete=?,detailsEnquete=?,dateLimite=?,formulaire=? WHERE id= ?',[$nomEnquete,$detailsEnquete,$dateLimite,$formulaire,$id]);
        return $result;
    }
    public static function updateStatusOffres($idOffres,$status){
        $result= DB:: update('UPDATE offres SET statusOffres=? WHERE id= ?',[$status,$idOffres]);
        return $result;
    }
    public static function getMaxIdOffre(){
        $result= DB:: select('select max(id) as id from offres');
        return $result;
    }
    function fctRetirerAccents($varMaChaine)
        {
            $search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
            //Préférez str_replace à strtr car strtr travaille directement sur les octets, ce qui pose problème en UTF-8
            $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');

            $varMaChaine = str_replace($search, $replace, $varMaChaine);
            return $varMaChaine; //On retourne le résultat
        }

}
