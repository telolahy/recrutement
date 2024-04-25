<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;
use App\Models\Enqueteur;
use App\Models\Postuleoffre;
use App\Models\Region;
use App\Models\Visiteur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Image;
use Session;
use Illuminate\Support\Facades\Validator;


class FrontController extends Controller
{
    //

    public function traitementLoginEnqueteur(){
        
        $email=$_POST['email'];
        $password = Hash::make(($_POST['password']));  //Password 
        //Login code

        if ($data = Enqueteur::where('email', $email)->first()) {
        $pass = Hash::check($_POST['password'], $data->motdepasse);
        if ($pass) {
                //session
                Session::put('idEnqueteur',$data->id);
                Session::put('nomEnqueteur',$data->nom);
                Session::put('prenomEnqueteur',$data->prenom);
                Session::put('photo',$data->photo);
                Session::put('email',$data->email);
                // listes des offres publies
                  // $totalOffrePublie=Offre::countOffrePublie();
                  // $total=$totalOffrePublie[0]->nombreOffre;    
                  // $result=3;
                  // $isapage=$total/$result;
                  // $numberPage=ceil($isapage); 
                  // $listeoffres= Offre::getAllOffre($result,1);
                
                 return redirect('ListesOffres?Page=1');
        } 
        else {
            $erreur= "Votre mot de passe est incorrecte";
             return view("FrontOffice/LoginEnqueteur",compact('erreur'));
        }
    }
     else {
        $erreur="Votre email est incorrecte" . "<br>";
         return view("FrontOffice/LoginEnqueteur",compact('erreur'));
    }
}   
    public function deconnexionEnqueteur(){
        Session::invalidate();
        return redirect()->route("LoginCandidats");
    }
    public function traitementInscription(Request $request){
         $this->validate($request, [
            'nom' => 'required', 
            'prenom' => 'required', 
            'dateNaissance' => 'required', 
            'email' => 'required|email|unique:enqueteurs', 
            'password' => 'required', 
            'photo' => 'required|image|mimes:jpg,png', 
            'Diplome' => 'required' ,

               
        ]);
        
        
            $nom=ucfirst($request->nom);
            $prenom=ucfirst($request->prenom);
        $dateNaissance=$request->dateNaissance;
        $email=$request->email;
            $file= $request->photo;
            // renommer fichier
            $filename=$file->getClientOriginalName();
             // upload fichier dans le repertoire ProfilEnqueteur
             $file-> move(public_path('ProfilEnqueteur'), $filename);
            //Image::make($file->getRealPath())->resize(468, 249)->save('public/ProfilEnqueteur/'.$filename);
            $photo= $filename;
            $motdepasse=Hash::make($request->password);
        $diplomes=$request->Diplome;
        $experiences=$request->experience;
        Enqueteur::create([
                    'nom' => ucfirst($request->nom),
                    'prenom' => ucfirst($request->prenom),
                    'dateNaissance' => $request->dateNaissance,
                    'email' => $request->email,
                    'motdepasse' => $motdepasse,
                    'photo' => $photo,
                    'experiences' => $request->experience,
                    'diplomes' => $request->Diplome,
                ]);
    
    //    Enqueteur::insertEnqueteur($nom,$prenom,$email,$motdepasse,$dateNaissance,$photo,$diplomes,$experiences);
        //var_dump($data->photo);
       $data = Enqueteur::where('email', $email)->first();
       Session::put('idEnqueteur',$data->id);
       Session::put('nomEnqueteur',$data->nom);
       Session::put('prenomEnqueteur',$data->prenom);
       Session::put('photo',$data->photo);
       Session::put('email',$data->email);
       return redirect('ListesOffres?Page=1');
    }


    //Listes Offres Front
    
    public function listesOffres(){
        $totalOffrePublie=Offre::countOffrePublie();
        $total=$totalOffrePublie[0]->nombreOffre;    
        $result=3;
        $isapage=$total/$result;
        $numberPage=ceil($isapage); 
    	$listeoffres= Offre::getAllOffre($result,$_GET['Page']);
       //  dd($listeoffres);
    	return view("FrontOffice/AcceuilFront",compact("listeoffres","numberPage"));
    }

    public function traitementDetailsOffres(Request $request){
    	$idOffre=$_GET['idOffre']; 
    	$detailsOffres= Offre::detailsOffres($idOffre);

//Chef Emile ---------------------------------------
        $visiteur= new Visiteur();
        $visiteur->offre_id=$idOffre;
        $visiteur->nombreVisiteurs=0;

        $visiteur->save();

        // dd($visiteur);

      if(Visiteur::getNombreVisiteurs($idOffre)){
        $VisteursChaqueOffre=Visiteur::getNombreVisiteurs($idOffre);  
        $nombreVisiteur=$VisteursChaqueOffre[0]->nombre;
        $reponse=$nombreVisiteur+1;
        Visiteur::updateNombreVissiteur($idOffre,$reponse);
        }
        else{
            Visiteur::insertVisiteur($idOffre,1);
      }
    	return view("FrontOffice/DetailsOffre",compact("detailsOffres"));
    }
    public function getFormulairesOffres(){
    	$idOffre=$_GET['idOffre'];
    	$listesformulaires= Offre::getFormulaireOffre($idOffre);
    	$val=json_decode($listesformulaires[0]->formulaire);
      $listesRegions=Region::getAllRegion(); 
    	return view("FrontOffice/Formulaire",compact("val","listesRegions"));
    }

    public function traitementPostuleEnqueteurs(Request $request){ 
        
    	$nomchamps=$request->nomchamps;
        $value=$nomchamps;
        $typechamps=$request->typechamps;
        $typefield=$request->typefield;
        $idoffres=$request->idOffre;
        $anneExperience=$request->anneExperience;
        $Page=$request->Page;
        $idEnqueteurs=Session::get('idEnqueteur');
        
        $listeschamps=Offre::getFormulaireOffre($idoffres);

        // dd($listeschamps);

        //Listes des champs de formulaires
        $val=json_decode($listeschamps[0]->formulaire);

    	$json=array();
        $tabfile=array();
        $inputNonNull=array();
        $formulairevalidation=array();
  
         
    	for ($key=0; $key <count($value) ; $key++) { 
            dump($value[$key]);
            if($request->hasFile($value[$key])){
                foreach ($request->Z as $key => $file) {
                    $filename=$file->getClientOriginalName();
       
                   $file-> move(public_path('DetailsEnqueteur'), $filename);
                }
                
       
               $valiny= $filename;
               $tabfile=$valiny;

               if($typefield[$key]=="text" || $typefield[$key]=="number"){
                $json[]= array(
               'champs'=> $value[$key],
               'valeur' => $request->$value,
               'typefield' => $typefield[$key]

           );
              }
           else{

               $json[]= array(
               'champs'=> $value[$key],
               'valeur' => $tabfile,
               'typefield' => $typefield[$key]


           );
           }

           }else{
           // dd("arofffff");

           }
           
        }
      //  dd($value);
             
            // if($value==$val[$key]->champs && $request->$value==null && $typechamps[$key]=="Obligatoire"){  
            // //array_push($tab,$value);
            //     $this->validate($request, [
            //          $value => 'required',   
            //      ]);
            
            // }

            // else{
            //      //var_dump($request->$value);
            //        if($typefield[$key]=="text" || $typefield[$key]=="number"){
            //          $json[]= array(
            //         'champs'=> $value,
            //         'valeur' => $request->$value,
            //         'typefield' => $typefield[$key]

            //     );
            //        }
            //     else{

            //         $json[]= array(
            //         'champs'=> $value,
            //         'valeur' => $tabfile,
            //         'typefield' => $typefield[$key]


            //     );
            //     }
            // }
        
            $detailsEnqueteurs=json_encode($json);
            dump($detailsEnqueteurs);
          //  dd($json);
        $valeurNonNull=count($inputNonNull); 
        $pourcentageFormulaire=Postuleoffre::getPourcentageFormulaire($valeurNonNull,$idoffres);
    
        $TypeEnqueteurs="";
        foreach ($nomchamps as $l => $v) {

            if($v=="Expériences" ||  $v=="Expérience"){
              $anneeMax=$anneExperience[$l]+2;
              if($request->$v>$anneeMax && $pourcentageFormulaire>80){
                 $TypeEnqueteurs="Expérimenté";
              }
              if($request->$v>=$anneExperience[$l] && $request->$v<=$anneeMax && $pourcentageFormulaire>=80){
                $TypeEnqueteurs="Moyen";
              }
              if($request->$v<$anneExperience[$l]){
                $TypeEnqueteurs="Novice";
              }

            }
        }

      //  dd($TypeEnqueteurs);

         // Chef Emile
         $postuleoffre= new Postuleoffre();
         $postuleoffre->offre_id=$idoffres;
         $postuleoffre->enqueteur_id=$idEnqueteurs;
         $postuleoffre->detailsEnqueteurs=$detailsEnqueteurs;
         $postuleoffre->typeEnqueteurs=$TypeEnqueteurs;
         $postuleoffre->datepostule=date('Y-m-d H:i:s');
         $postuleoffre->save();

       
    //    $TypeEnqueteurs=Postuleoffre::insertPostuleOffre($idoffres,$detailsEnqueteurs,$idEnqueteurs,$TypeEnqueteurs);
    //    dd($TypeEnqueteurs);
        $result=3;

        $listeoffres= Offre::getAllOffre($result,$Page);
        return redirect('ListesOffres?Page='.$Page);
       
    }

    public function traitementHistoriques(){
        $idEnqueteurs=Session::get('idEnqueteur');
        $HistoriquesPostulesOffres= Postuleoffre::HistoriqueOffrePostules($idEnqueteurs);
        return view("FrontOffice/Historiques",compact("HistoriquesPostulesOffres"));
    }
    public function traitementProfilUtilisateur(){
         $idEnqueteurs=Session::get('idEnqueteur');
        $ficheEnqueteurs=Enqueteur::profilUtilisateur($idEnqueteurs);
        return view("FrontOffice/ProfilUtilisateur",compact("ficheEnqueteurs"));
    }
    public function traitementModificationProfil(Request $request){
        $this->validate($request, [
            'nom' => 'required', 
            'prenom' => 'required', 
            'dateNaissance' => 'required', 
            'email' => 'required|email', 
            'photo' => 'required|image|mimes:jpg,png', 
            'diplomes' => 'required' 
               
        ]);
         
        $idEnqueteurs=Session::get('idEnqueteur');  
        $nom=$request->nom;
        $prenom=$request->prenom;
        $email=$request->email;
        $dateNaissance=$request->dateNaissance;
       // $photo=$request->filename;
        $diplomes=$request->diplomes;
        $experiences=$request->experiences;
         if($request->hasFile("photo")){
                 $file=$request->photo;
                 $filename=$file->getClientOriginalName();
    
                $file-> move(public_path('ProfilEnqueteur'), $filename);
        
                $photo=$filename;
            }
        Enqueteur::updateprofilUtilisateur($idEnqueteurs,$nom,$prenom,$email,$dateNaissance,$photo,$diplomes,$experiences);
        Session::put('nomEnqueteur',$nom);
        Session::put('prenomEnqueteur',$prenom);
        Session::put('photo',$photo);
        Session::put('email',$email);
        $ficheEnqueteurs=Enqueteur::profilUtilisateur($idEnqueteurs);
        return view("FrontOffice/ProfilUtilisateur",compact("ficheEnqueteurs"));
}
  public function modificationMotDepasseEnqueteur(Request $request){
    $this->validate($request, [
            'motdepasseActuel' => 'required', 
            'nouveauMotdepasse' => 'required', 
            'confirmationMotdepasse' => 'required'
        ]);
    $idEnqueteurs=Session::get('idEnqueteur');
    $ficheEnqueteurs=Enqueteur::profilUtilisateur($idEnqueteurs);
        if (Hash::check($request->motdepasseActuel, $ficheEnqueteurs[0]->motdepasse)) {
          if($request->nouveauMotdepasse==$request->confirmationMotdepasse){
            $motdepasseVaovao=Hash::make($request->nouveauMotdepasse);
            Enqueteur::updateMotdePasse($motdepasseVaovao,$idEnqueteurs);
            $notif="Votre mot de passe a bien été modifié";
            return view("FrontOffice/ProfilUtilisateur",compact("ficheEnqueteurs","notif"));
          }
          else {
                $erreur="Il y a eu une erreur lors du changement de votre mot de passe";
                //return view("FrontOffice/ProfilUtilisateur",compact("ficheEnqueteurs","erreur"));       
            }
     }
     else {
            $erreur="Ce n'est pas votre mot de passe actuel";
            $ficheEnqueteurs=Enqueteur::profilUtilisateur($idEnqueteurs);
            return view("FrontOffice/ProfilUtilisateur",compact("ficheEnqueteurs","erreur"));
          }
  }         
}
