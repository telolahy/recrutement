<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Offre;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Visiteur;
use App\Models\Administrateur;
use App\Models\Postuleoffre;
use App\Models\Region;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Librairies\FileManagerLibrary;
use Session;
use \DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\SimpleExcel\SimpleExcelReader;

class BackController extends Controller
{
    //

     public function listes(){
        $nomrole=Session::get('nomrole');
        $idDirection=Session::get('idDirection');
        $listrole= Role::listesroles($nomrole);
    	$listpost= Poste::listespostes($nomrole);
    	$listDirection= Direction::listesDirection($nomrole,$idDirection);
    	// $idAdmin= Auth::user()->id;
     //    $val= Administrateur::getRoleAdmin($idAdmin);
     //    Session::put('nomrole', $val[0]->nomrole);
        //$nomrole=$val[0]->nomrole;

    	return view("BackOffice/AjoutAdministrateur",compact("listpost","listrole","listDirection"));
    }

    public function fonctionajoutAdmin(Request $request){
        $this->validate($request,[
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email|unique:administrateurs',
            'password'=>'required',
            'idRole' =>'required',
            'idPoste' =>'required',
            'idDirection' =>'required'
        ]);
            $nom=ucfirst($request->nom);
            $prenom=ucfirst($request->prenom);
            $email=$request->email;
            $password=Hash::make($request->password);
            $role_id=$request->idRole;
            $poste_id=$request->idPoste;
            $direction_id=$request->idDirection;
            $status="Active";

        Administrateur::insertAdministrateur($nom,$prenom,$email,$password,$role_id,$poste_id,$direction_id,$status);
        $listpost= Poste::get();
        $listrole= Role::get();
        $listDirection= Direction::get();

        return view("BackOffice/AjoutAdministrateur",compact("listpost","listrole","listDirection"));
    }

    // public function listesAdministrateurs(){
    //     $ad= Administrateur::countAdmin();

    //     $nombreAdmin=$ad[0]->isa;

    //     $result=3;
    //     $isapage=$nombreAdmin/$result;
    //     $numberPage=ceil($isapage);
    //     $val="";
    //     $listroles= Role::get();
    //     if(isset($_GET['Page'])){
    //           $val= Administrateur::listesComptePagination($_GET['Page'],$result);
    //     }

    //     return view("BackOffice/ListesDesComptes",compact("val","listroles","numberPage"));
    // }


    public function listesAdministrateurs(){
        
        $nomRole=(Session::get('nomrole'));
        $ad = Administrateur::countAdmin();
        $nombreAdmin = $ad[0]->isa;
        $result = 3; // Nombre d'éléments par page
        $isapage = $nombreAdmin / $result;
        $numberPage = ceil($isapage);
        $val = "";
        $listroles = Role::get();

        // Vérification de la variable $offset
        $page = isset($_GET['Page']) ? intval($_GET['Page']) : 1;
        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $result;

        if ($page > $numberPage) {
            // Gestion de la page invalide, rediriger vers la première page
            return redirect()->route('listesAdministrateurs');
        }

        if ($page > 0) {
            $val = Administrateur::listesComptePagination($result, $offset,$nomRole);
        }

        return view("BackOffice/ListesDesComptes", compact("val", "listroles", "numberPage"));
    }


    public function supprimerComptes($id){

         $user =Administrateur::find($id);

        $user->delete();

        $ad= Administrateur::countAdmin();
        $nombreAdmin=$ad[0]->isa;
        $result=3;
        $isapage=$nombreAdmin/$result;
        $numberPage=ceil($isapage);

          $listroles= Role::get();
        $val= Administrateur::listesComptePagination($_GET['Page'],$result);
        $Page=$_GET['Page'];
        return redirect()->route('Comptes',compact("val","listroles","numberPage","Page"));
    }
    public function modificationstatusAdmin(){
        $idUser=$_GET['idAdmin'];
        $ad = DB::table('administrateurs')
            ->select('status')->where('id','=',$idUser)
            ->get();
        $status= $ad[0]->status;

        if($status=="Active"){
            $status="Descative";
        }
        else{
            $status="Active";

        }

        Administrateur::updateAdmin($status,$idUser);
        $result=$status;
        if($result){
            echo $status;
        }
    }
    // page de details Admin
    public function ficheAdmin(){
        $idAdmin=$_GET['idAdmin'];
        $reponse= Administrateur::getFicheAdmin($idAdmin);
        return view("BackOffice/FicheAdmin",compact("reponse"));
    }
    public function listesDesAgentsEnqueteurs(){
        $idoffres=$_GET['idOffre'];
        $nomEnquete=Offre::getNomEnquete($idoffres);
        $nomOffre=$nomEnquete[0]->nomEnquete;

        //TypesEnqueteurs
        $types=['Expérimenté','Moyen','Novice'];
        //nombres des visiteurs
        $nombreVisiteurs=Visiteur::getNombreVisiteurs($idoffres);
        //statistique sur le nombre total de candidat qui ont postules sur un offre
        $NombreTotaldecandidats=Postuleoffre::statistiqueCandidatsPourOffre($idoffres);
        $totalCandidatsOffre=$NombreTotaldecandidats[0]->nombrecandidats;

        //statistique sur les types de candidats;
         $nombreDesCandidatsParCategorie=Postuleoffre::getNombreTypeCandidatsParOffre($idoffres);
        //raha mis postules
        if(Postuleoffre::listespostules($idoffres)){
        $nombrePostule=Postuleoffre::countPostuleOffres($idoffres);
        $total=$nombrePostule[0]->isa;
        //nombre de lignes
        $result=5;
        $isapage=$total/$result;
        $numberPage=ceil($isapage);
        $reponse=Postuleoffre::listesPostulesOffres($idoffres,$result,$_GET['Page']);



       for ($i=0; $i <count($reponse); $i++) {
           $ListesEnqueteurs[]=json_decode($reponse[$i]->detailsEnqueteurs);
       }
       for($j=0; $j<count($ListesEnqueteurs[0]); $j++) {
                if($ListesEnqueteurs[0][$j]->champs=="Régions" || $ListesEnqueteurs[0][$j]->champs=="Région" || $ListesEnqueteurs[0][$j]->champs=="Région(s)"){
                    $valiny=$ListesEnqueteurs[0][$j]->champs;
                    $listesRegions=Region::getAllRegion();
                    $data=array();

                   // Statistique candidat par region
                    for($jo=0;$jo<count($listesRegions);$jo++){
                        $nombrecandidatParRegion=Postuleoffre::statistiqueCandidatParRegion($idoffres,$valiny,$listesRegions[$jo]->nom);
                        $data[]=array(
                            'country' =>$listesRegions[$jo]->nom,
                            'value' => $nombrecandidatParRegion[0]->isacandidat
                        );
                    }
                    $encodeliste = json_encode($data);

                    return view("BackOffice/ListesEnqueteurs",compact("ListesEnqueteurs","nomOffre","numberPage","valiny","listesRegions","encodeliste","totalCandidatsOffre","nombreDesCandidatsParCategorie","nombreVisiteurs","types"));
                }
        }

            return view("BackOffice/ListesEnqueteurs",compact("ListesEnqueteurs","nomOffre","numberPage","totalCandidatsOffre","nombreDesCandidatsParCategorie","nombreVisiteurs"));
       }
       else{
            return view("BackOffice/ListesEnqueteurs",compact("nomOffre","totalCandidatsOffre","nombreDesCandidatsParCategorie","nombreVisiteurs"));
       }
    }
    public function downloadfile(){
        $nomfichier=$_GET['nomfichier'];
        $file = public_path(). "/DetailsEnqueteur/".$nomfichier;
        $headers = ['Content-Type: file/pdf'];
         if (file_exists($file)) {
        return \Response::download($file, $nomfichier, $headers);
        } else {
        echo('File not found.');
     }
    }
    public function downloadphoto(){
        $nomImage=$_GET['nomImage'];
        $image=public_path(). "/DetailsEnqueteur/".$nomImage;
        $type= ['Content-Type:image:png,jpg'];
        if(file_exists($image)){
        return \Response::download($image,$nomImage,$type);
        }
        else{
            echo('Image not found');
        }
    }
    public function RechercherParRegion(){

        $nomRegion=$_GET['nomRegion'];
        $idoffres=$_GET['idoffre'];
        $nomchamps=$_GET['nomchamps'];
        $typeEnqueteur=$_GET['typeEnqueteur'];
        $types=['Expérimenté','Moyen','Novice'];
        //nombres des visiteurs
        $nombreVisiteurs=Visiteur::getNombreVisiteurs($idoffres);

        $nomEnquete=Offre::getNomEnquete($idoffres);
        $nomOffre=$nomEnquete[0]->nomEnquete;
         $listesRegions=Region::getAllRegion();

         //statistique sur le nombre total de candidat qui ont postules sur un offre
        $NombreTotaldecandidats=Postuleoffre::statistiqueCandidatsPourOffre($idoffres);
        $totalCandidatsOffre=$NombreTotaldecandidats[0]->nombrecandidats;

        //Statistique candidats par Region
         $data=array();
        for($ind=0;$ind<count($listesRegions);$ind++){
                $nombrecandidatParRegion=Postuleoffre::statistiqueCandidatParRegion($idoffres,$nomchamps,$listesRegions[$ind]->nom);
                $data[]=array(
                    'country' =>$listesRegions[$ind]->nom,
                    'value' => $nombrecandidatParRegion[0]->isacandidat
                );
        }
        $encodeliste = json_encode($data);

         //statistique sur les types de candidats;
         $nombreDesCandidatsParCategorie=Postuleoffre::getNombreTypeCandidatsParOffre($idoffres);

        if($nomRegion=="Tous"){
            $nombrePostule=Postuleoffre::countPostuleOffres($idoffres);
            $total=$nombrePostule[0]->isa;
            //nombre listes
            $result=5;
            $isapage=$total/$result;
            $numberPage=ceil($isapage);
            //listes des personnes qui ont postules sur offre
            $reponse=Postuleoffre::listesPostulesOffres($idoffres,$result,$_GET['Page']);
            for ($i=0; $i <count($reponse); $i++) {
                $ListesEnqueteurs[]=json_decode($reponse[$i]->detailsEnqueteurs);
            }
            return view("BackOffice/ListesRechercheParRegion",compact("ListesEnqueteurs","nomOffre","numberPage","idoffres","nomchamps","listesRegions","encodeliste","totalCandidatsOffre","nombreDesCandidatsParCategorie","nombreVisiteurs","types"));
        }
        else{
        $val=Postuleoffre::getListesParRegion($idoffres,$nomchamps,$nomRegion,$typeEnqueteur);
        $TotalPersonneParRegion=count($val);
        if($TotalPersonneParRegion>0){
            //nombres de lignes
            $result=5;
        $isapage=$TotalPersonneParRegion/$result;
        $numberPage=ceil($isapage);
        $rep=Postuleoffre::filtreParRegion($idoffres,$nomchamps,$nomRegion,$typeEnqueteur,$result,$_GET['Page']);
        for ($i=0; $i <count($rep); $i++) {
           $ListesEnqueteurs[]=json_decode($rep[$i]->detailsEnqueteurs);


       }
       return view("BackOffice/ListesRechercheParRegion",compact("ListesEnqueteurs","nomOffre","numberPage","idoffres","nomchamps","listesRegions","encodeliste","totalCandidatsOffre","nombreDesCandidatsParCategorie","nombreVisiteurs","types"));
       }
       else{

            return view("BackOffice/ListesRechercheParRegion",compact("nomOffre","idoffres","nomchamps","listesRegions","encodeliste","totalCandidatsOffre","nombreDesCandidatsParCategorie","nombreVisiteurs","types"));
       }
       }

    }

    // public function TraitementExportExcel(Request $request){
    //     $idOffres=$request->idOffre;

    //     //  /* file name */
    //     $filename = 'Listes des Enqueteurs.csv';
    //     header("Content-Description: File Transfer");
    //     header("Content-Disposition: attachment; filename=$filename");
    //     header("Content-Type: application/csv; ");
    //    /* get data */
    //     $ListesEnqueteurs=Postuleoffre::listespostules($idOffres);
    //     for ($i=0; $i <count($ListesEnqueteurs); $i++) {
    //             $Listes[]=json_decode($ListesEnqueteurs[$i]->detailsEnqueteurs);
    //     }
    //     /* file creation */
    //     $file = fopen('php://output','w');
    //     $val=array();
    //        for ($i=0; $i <count($Listes[0]) ; $i++) {
    //             $nomchamps=Offre::fctRetirerAccents($Listes[0][$i]->champs);
    //           $val[]=strtoupper($nomchamps);
    //     }
    //     //entete
    //     $header=$val;
    //     //fputcsv($file,$header);
    //     foreach ($header as $key) {
    //         $top=$key.';';
    //         fputs($file,$top);
    //     }
    //     fputs($file,"\n");
    //      $isa=count($header)-1;
    //      $data=array();
    //      for ($u=0; $u <count($Listes) ; $u++) {
    //         for ($t=0; $t <count($Listes[0]) ; $t++) {
    //             $valiny=$Listes[$u][$t]->valeur.';';
    //             fputs($file,$valiny);
    //             if($Listes[$u][$t]->champs==$val[$isa]){
    //                 fputs($file,"\n");
    //             }


    //         }

    //     }

    //      fclose($file);
    //      exit;
    // }

    public function TraitementExportExcel(Request $request){
        $idOffres = $request->idOffre;
    
        // Nom du fichier
        $filename = 'Listes des Enqueteurs.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");
        
        // Récupérer les données
        $ListesEnqueteurs = Postuleoffre::listespostules($idOffres);
        for ($i = 0; $i < count($ListesEnqueteurs); $i++) {
            $Listes[] = json_decode($ListesEnqueteurs[$i]->detailsEnqueteurs);
        }
    
        // Création du fichier
        $file = fopen('php://output','w');
        $val = array();
        for ($i = 0; $i < count($Listes[0]); $i++) {
            $nomchamps = Offre::fctRetirerAccents($Listes[0][$i]->champs);
            $val[] = strtoupper($nomchamps);
        }
    
        // En-tête
        $header = $val;
        foreach ($header as $key) {
            $top = $key . ';';
            fputs($file, $top);
        }
        fputs($file, "\r\n");
    
        // Données
        $isa = count($header) - 1;
        for ($u = 0; $u < count($Listes); $u++) {
            for ($t = 0; $t < count($Listes[0]); $t++) {
                $valiny = $Listes[$u][$t]->valeur . ';';
                fputs($file, $valiny);
                if ($Listes[$u][$t]->champs == $val[$isa]) {
                    fputs($file, "\r\n"); // Ajouter un saut de ligne ici
                }
            }
        }
    
        fclose($file);
        exit;
    }
    

}
