<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Offre;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Administrateur;
use App\Models\AccesOffre;
use App\Models\Typechamps;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Librairies\FileManagerLibrary;
use Session;
use \DateTime;
use Illuminate\Support\Facades\DB;

class OffreController extends Controller
{
    //
    public function PageAjoutOffre(){
        
        $idAdmin= Auth::user()->id;
        $nomrole=Session::get('nomrole');
        $idDirection=Session::get('idDirection');
        $listesTypeChamps=Typechamps::get();
        $donneacces=Administrateur::accesOffres($idAdmin,$idDirection,$nomrole);
        return view("BackOffice/AjoutOffre",compact("donneacces","listesTypeChamps"));
    }
    // traitement Ajout Offre
     public function ajoutOffre(Request $req){
        ini_set('max_execution_time',600);
        try{
          DB::beginTransaction();
    	$nomEnquete= $req['nomEnquete'];
    	$dateLimite= $req['dateLimite'];

    	$idAdmin= Auth::user()->id;
    	$nomchamps= $req['nomchamps'];
    	$type= $req['type'];
        $typechamps= $req['typechamps'];
        $anneeExperience= $req['anneeExperience'];

        $filemanagerLibrary = new FileManagerLibrary;
        $body =  $req['DetailsEnquete'];
        $dom = new \DOMDocument();
        $dom = $filemanagerLibrary->domDocumentEncoding($body);
        $body = $dom->saveHTML();

        // $page->body = $page->reformatBodyText();

        // $page->fill($data);
        // $page->save();
    	$json=array();
    	foreach ($nomchamps as $key => $value) {
           // $valeurchamps=Offre::fctRetirerAccents($value);
            // 'champs'=>  strtoupper($valeurchamps),
    		$json[]= array(
            'champs'=>  ucfirst($value),
    		'type' => $type[$key],
            'typechamps' => $typechamps[$key],
            'anneeExperience' => $anneeExperience
    	);
    	}
    	$encodage = json_encode($json);

        $statusOffres="Non publie";
        // Offre::insertOffre($nomEnquete,$body,$dateLimite,$idAdmin,$encodage,$statusOffres);
        Offre::create([
            'nomEnquete' => $nomEnquete,
            'detailsEnquete' => $body,
            'dateDebut' => now(), // Remplacez now() par la date de début souhaitée
            'statusOffres' => $statusOffres, // Remplacez now() par le statut d'offre souhaité
            'dateLimite' => $dateLimite, // Remplacez now()->addDays(7) par la date limite souhaitée
            'administrateur_id' => 1, // Remplacez 1 par l'ID de l'administrateur correspondant
            'formulaire' =>$encodage, // Remplacez par les données du formulaire au format JSON
        ]);
        
        if(isset($req['idPersonnel'])){
            $idPersonnel=$req['idPersonnel'];
            $id=offre::getMaxIdOffre();
            $idOffres=$id[0]->id;
            for ($i=0; $i <count($idPersonnel) ; $i++) {
               // Création d'un nouvel enregistrement avec la méthode create
                    AccesOffre::create([
                        'offre_id' => 1, // Remplacez 1 par l'offre_id correspondant
                        'administrateur_id' => 1, // Remplacez 1 par l'administrateur_id correspondant
                        'etat' => 'Actif',
                    ]);

                // DB:: insert('INSERT INTO accesoffres VALUES(null,?,?,?)',[$idOffres,$idPersonnel[$i],"Active"]);
                
            }
        }

            DB::commit();
            $notif="L'offre a été ajouté";
            $idAdmin= Auth::user()->id;
        $nomrole=Session::get('nomrole');
        $idDirection=Session::get('idDirection');
         $listesTypeChamps=Typechamps::get();
        $donneacces=Administrateur::accesOffres($idAdmin,$idDirection,$nomrole);
        return view("BackOffice/AjoutOffre",compact("notif","donneacces","listesTypeChamps"));
        }
        catch(Exception $e){
             DB::rollback();
            throw $e;
        }

    }

    
    // listes Offres avec pagination
    // public function listesOffres(){
    //     $idAdmin= Auth::user()->id;
    //     $nomrole=Session::get('nomrole');
    //     $idDirection=Session::get('idDirection');

    //     $nbrOffres=Offre::countListesOffres($nomrole,$idDirection,$idAdmin);
    //     $isaOffres=count($nbrOffres);
    //     $result=5;
    //     $isapage=$isaOffres/$result;
    //     $numberPage=ceil($isapage);

    //     //if(isset($_GET['Page'])){
    //           $listes= Offre::getListesOffres($nomrole,$idDirection,$idAdmin,$result,$_GET['Page']);
    //     //}
    //     //else{
    //         //$listes= Offre::getListesOffres($nomrole,$idDirection,$idAdmin,$result,1);
    //    // }
    //     return view("BackOffice/ListesOffres",compact("listes","numberPage"));
    // }
    public function listesOffres(){
        $idAdmin = Auth::user()->id;
        $nomrole = Session::get('nomrole');
        $idDirection = Session::get('idDirection');

        $nbrOffres = Offre::countListesOffres($nomrole, $idDirection, $idAdmin);
        $isaOffres = count($nbrOffres);
        $result = 5;
        $isapage = $isaOffres / $result;
        $numberPage = ceil($isapage);

        // Vérifie si le paramètre "Page" est défini
        $currentPage = isset($_GET['Page']) ? $_GET['Page'] : 1;
        // Utilise le paramètre "Page" défini ou la valeur par défaut 1
        $listes = Offre::getListesOffres($nomrole, $idDirection, $idAdmin, $result, $currentPage);

        return view("BackOffice/ListesOffres", compact("listes", "numberPage"));
    }



    public function pageModificationOffre(){
    	$idOffres=$_GET['idOffre'];
    	$valeurOffre=Offre::getOffreById($idOffres);
        //role Administrateurs qui a creer offre
        $acces=Administrateur::getRoleAdminCreerOffre($idOffres);
        // listes de tous les administrateur qu on peut donner un acces
        $donneacces=Administrateur::accesOffres($acces[0]->idAdmin,$acces[0]->idDirection,$acces[0]->nomrole);
        // listes des Administrateurs active
        $listescoches=AccesOffre::listesAdminAccesOffres($idOffres);
        $listesTypeChamps=Typechamps::get();
    	return view("BackOffice/ModificationOffre",compact("valeurOffre","donneacces","listescoches","listesTypeChamps"));
    }
    public function traitementModificationOffre(){
    	$nomEnquete=$_POST['nomEnquete'];
    	$dateLimite=$_POST['dateLimite'];
        $idOffres=$_POST['idOffres'];
        $nomchamps=$_POST['nomchamps'];
        $typechamps=$_POST['typechamps'];
        $anneeExperience=$_POST['anneeExperience'];

        $type=$_POST['type'];

        $filemanagerLibrary = new FileManagerLibrary;
        $body = $_POST['DetailsEnquete'];

        $dom = new \DOMDocument();
        $dom = $filemanagerLibrary->domDocumentEncoding($body);

        $body = $dom->saveHTML();
        $json=array();
        foreach ($nomchamps as $key => $value) {
            //$valeurchamps=Offre::fctRetirerAccents($value);
            $json[]= array(
            'champs'=> ucfirst($value),
            'type' => $type[$key],
            'typechamps' => $typechamps[$key],
            'anneeExperience' => $anneeExperience
        );
        }
        $formulaire = json_encode($json);
        Offre::updateOffre($nomEnquete,$body,$dateLimite,$formulaire,$idOffres);

        $idAdmin= Auth::user()->id;
        $nomrole=Session::get('nomrole');
        $idDirection=Session::get('idDirection');
        //Pagination Offre
        $nbrOffres=Offre::countListesOffres($nomrole,$idDirection,$idAdmin);
        $isaOffres=count($nbrOffres);
        //limit offre
        $result=5;
        $isapage=$isaOffres/$result;
        $numberPage=ceil($isapage);
        $listes=Offre::getListesOffres($nomrole,$idDirection,$idAdmin,$result,1);
        return redirect('Acceuil?Page=1')->with(compact("listes","numberPage"));
        // return view("BackOffice/ListesOffres",compact("listes","numberPage"));

}
    public function ModificationEtatAccesOffre(){
        $Admin=$_GET['idAdminstrateur'];
        $idoffres=$_GET['idoffre'];
        if(AccesOffre::getAccesOffre($idoffres,$Admin)){
            $d=AccesOffre::getAccesOffre($idoffres,$Admin);
            $etat= $d[0]->etat;

            if($etat=="Active"){
                $etat="Descative";
            }
            else{
                $etat="Active";
            }
        AccesOffre::updateEtatAccesOffre($idoffres,$Admin,$etat);
        $result=$etat;
        if($result){
            echo $etat;
        }
        }
        else{
            AccesOffre::insertAccesOffres($idoffres,$Admin,"Active");
            $result="Active";
            if($result){
                echo $result;
            }
        }

    }
    // Modification status offres lorsque on publie un offre
    public function traitementModificationStatus(){
        $idOffres=$_GET['idOffre'];
        $status="publie";
        Offre::updateStatusOffres($idOffres,$status);

        $idAdmin= Auth::user()->id;
        $nomrole=Session::get('nomrole');
        $idDirection=Session::get('idDirection');
        //Pagination Offre
        $nbrOffres=Offre::countListesOffres($nomrole,$idDirection,$idAdmin);
        $isaOffres=count($nbrOffres);
        //limit offre
        $result=5;
        $isapage=$isaOffres/$result;
        $numberPage=ceil($isapage);
        $listes=Offre::getListesOffres($nomrole,$idDirection,$idAdmin,$result,1);
        $Page=$_GET['Page'];
        return redirect('Acceuil?Page='.$Page)->with(compact("listes","numberPage"));
        //return view("BackOffice/ListesOffres",compact("listes","numberPage"));
    }

}
