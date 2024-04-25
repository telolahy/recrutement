<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Enqueteur extends Model
{
	protected $fillable = ['nom','prenom','email','motdepasse','dateNaissance','photo','diplomes','experiences'];
	protected $table = 'enqueteurs';
    use HasFactory;
    
    public static function insertEnqueteur($nom,$prenom,$email,$motdepasse,$dateNaissance,$photo,$diplomes,$experiences){
    		$result= DB:: insert('INSERT INTO enqueteurs VALUES(null,?,?,?,?,?,?,?,?)',[$nom,$prenom,$email,$motdepasse,$dateNaissance,$photo,$diplomes,$experiences]);
        	return $result;
    }
    public static function loginEnqueteur($email,$motdepasse){
    	$result= DB:: select('SELECT*from enqueteurs WHERE email = ? and motdepasse= ?',[$email,$motdepasse]);
    	return $result;
    }
    public static function profilUtilisateur($idEnqueteurs){
        $result= DB:: select('SELECT*from enqueteurs WHERE id = ?',[$idEnqueteurs]);
        return $result;
    }
    public static function updateprofilUtilisateur($idEnqueteurs,$nom,$prenom,$email,$dateNaissance,$photo,$diplomes,$experiences){
        $result= DB:: update('UPDATE enqueteurs SET nom=?,prenom=?,email=?,dateNaissance=?,photo=?,diplomes=?,experiences=? WHERE id= ?',[$nom,$prenom,$email,$dateNaissance,$photo,$diplomes,$experiences,$idEnqueteurs]);
        return $result;
    }
    public static function updateMotdePasse($nouveauMdp,$idEnqueteurs){
         $result= DB:: update('UPDATE enqueteurs SET motdepasse=? WHERE id= ?',[$nouveauMdp,$idEnqueteurs]);
        return $result;
    }
}
