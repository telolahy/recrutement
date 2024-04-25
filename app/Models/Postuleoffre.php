<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Offre;
use App\Models\Visiteur;

class Postuleoffre extends Model
{
    use HasFactory;

	public static function insertPostuleOffre($offre_id,$detailsEnqueteurs,$enqueteur_id,$TypeEnqueteurs){
    	$result= DB:: insert('INSERT INTO postuleoffres VALUES(null,?,?,now(),?,?)',[$offre_id,$detailsEnqueteurs,$enqueteur_id,$TypeEnqueteurs]);
    	return $result;
    }
    public static function listespostules($idoffres){
    	$result= DB:: select('SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=?',[$idoffres]);
        return $result;
    }
    public static function listesPostulesOffres($idoffres,$limit,$page){
    	$lim=$limit;
        $ofs=$page*$limit;
        $ligne=$ofs-$limit;
    	$result= DB:: select('SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? LIMIT ? offset ?',[$idoffres,$lim,$ligne]);
        return $result;
    }
    public static function countPostuleOffres($idoffres){
    	$result= DB:: select('SELECT count(detailsEnqueteurs) as isa FROM postuleoffres WHERE offre_id=?',[$idoffres]);
        return $result;
    }
    public static function getListesParRegion($idoffres,$champs,$nomregion,$TypeEnqueteurs){
         if($nomregion!=null && $TypeEnqueteurs==null){
        $result= DB:: select("SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? and JSON_SEARCH (`detailsEnqueteurs`, 'all',?, NULL,'$[*].champs') IS NOT NULL 
and JSON_SEARCH (`detailsEnqueteurs`, 'all',(?), NULL,'$[*].valeur') IS NOT NULL",[$idoffres,$champs,$nomregion]);
    }
    if($nomregion==null && $TypeEnqueteurs!=null){
            $result= DB:: select("SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? and typeEnqueteurs=?",[$idoffres,$TypeEnqueteurs]);
        }
        if($nomregion!=null && $TypeEnqueteurs!=null){
             $result= DB:: select("SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? and JSON_SEARCH (`detailsEnqueteurs`, 'all',?, NULL,'$[*].champs') IS NOT NULL 
and JSON_SEARCH (`detailsEnqueteurs`, 'all',(?), NULL,'$[*].valeur') IS NOT NULL and TypeEnqueteurs=?",[$idoffres,$champs,$nomregion,$TypeEnqueteurs]);
        }
        return $result;
    }
    
    public static function filtreParRegion($idoffres,$champs,$nomregion,$TypeEnqueteurs,$limit,$page){
        $lim=$limit;
        $ofs=$page*$limit;
        $ligne=$ofs-$limit;
        if($nomregion!=null && $TypeEnqueteurs==null){
            $result= DB:: select("SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? and JSON_SEARCH (`detailsEnqueteurs`, 'all',?, NULL,'$[*].champs') IS NOT NULL 
and JSON_SEARCH (`detailsEnqueteurs`, 'all',(?), NULL,'$[*].valeur') IS NOT NULL LIMIT ? offset ?",[$idoffres,$champs,$nomregion,$lim,$ligne]);
        }
        if($nomregion==null && $TypeEnqueteurs!=null){
            $result= DB:: select("SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? and typeEnqueteurs=? LIMIT ? offset ?",[$idoffres,$TypeEnqueteurs,$lim,$ligne]);
        }
        if($nomregion!=null && $TypeEnqueteurs!=null){
             $result= DB:: select("SELECT detailsEnqueteurs FROM postuleoffres WHERE offre_id=? and JSON_SEARCH (`detailsEnqueteurs`, 'all',?, NULL,'$[*].champs') IS NOT NULL 
and JSON_SEARCH (`detailsEnqueteurs`, 'all',(?), NULL,'$[*].valeur') IS NOT NULL and TypeEnqueteurs=? LIMIT ? offset ?",[$idoffres,$champs,$nomregion,$TypeEnqueteurs,$lim,$ligne]);
        }
        return $result;
    }

    public static function statistiqueCandidatParRegion($idoffres,$nomchamps,$valeur){
        $result= DB::select("SELECT count(detailsEnqueteurs) as isacandidat FROM postuleoffres WHERE offre_id=? and JSON_SEARCH (`detailsEnqueteurs`, 'all',?,'','$[*].champs') IS NOT NULL and JSON_SEARCH (`detailsEnqueteurs`, 'all',?, NULL,'$[*].valeur') IS NOT NULL",[$idoffres,$nomchamps,$valeur]);
        return $result;
    }
    public static function statistiqueCandidatsPourOffre($idoffres){
        $req= DB::select("SELECT count(enqueteur_id) as nombrecandidats from postuleoffres WHERE offre_id=?",[$idoffres]);
        return $req;
    }
    public static function getPourcentageFormulaire($inputNonNull,$idoffres){
        $listesFormulaires=Offre::getFormulaireOffre($idoffres);
        $valiny=json_decode($listesFormulaires[0]->formulaire);
        $isaFormulaires=count($valiny);
        $pourcentage=(100*$inputNonNull)/$isaFormulaires;
        $pourcentageArrondi=round($pourcentage);
        return $pourcentageArrondi;
    }
    public static function statistiqueTypeCandidats($idoffres,$TypeEnqueteurs){
        $req= DB::select("SELECT count(enqueteur_id) as totalCandidats from postuleoffres WHERE offre_id=? and TypeEnqueteurs=?",[$idoffres,$TypeEnqueteurs]);
        return $req;
    }
    public static function getNombreTypeCandidatsParOffre($idOffres)
    {
        $types=['Expérimenté','Moyen','Novice'];
        $valeur=array();
       
        for($o=0;$o<count($types);$o++){
            $nombrecandidats= Postuleoffre::statistiqueTypeCandidats($idOffres,$types[$o]);
          
            $valeur[]=array(
                            'country' =>$types[$o],
                            'visits' => $nombrecandidats[0]->totalCandidats,
                            'columnSettings' => '{ fill: colors.next() }'
                        );     
        }
        
        
        $listesTypesCandidats=json_encode($valeur);
        return $listesTypesCandidats;

    }

    public static function HistoriqueOffrePostules($idenqueteurs){
        $result= DB::select("SELECT*FROM postuleoffres p join offres o on p.offre_id=o.id WHERE enqueteur_id=?",[$idenqueteurs]);
        return $result;
    }
    
}
