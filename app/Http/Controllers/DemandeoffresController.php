<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poste;
use App\Models\Offre;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Demandeoffre;

class DemandeoffresController extends Controller
{
    public function demandeOffre(){
    	$listpost= Poste::get();
    	$listDirection= Direction::get();
    	return view("BackOffice/DemandeOffres",compact("listpost","listDirection"));
    }
    public function store(Request $request)
    {
    	 $this->validate($request,[
            'nom'=>'required',
            'prenom'=>'required',
            'nomEnquete'=>'required',
            'idposte'=>'required',
            'idDirection' =>'required'
        ]);

        $demandeoffres = new Demandeoffre;
        $date= Offre::getnow();
        $data = [
            'nom' =>$request->nom,
            'prenom' =>$request->prenom,
            'nomEnquete' =>$request->nomEnquete,
            'dateDemande' =>$date[0]->datedebut,
            'poste_id' =>$request->idposte,
            'direction_id' =>$request->idDirection,
        ];

        $demandeoffres->fill($data)->save();
        // flash('Bannière '.$banner->post->title.' créée avec succès!','success');
        $listpost= Poste::get();
        $listDirection= Direction::get();
        return view('BackOffice/DemandeOffres',compact("listpost","listDirection"));
       
    }
    public function listeDemande(){
        $reponse= Demandeoffre::getListeDemandeOffre();
        return view("BackOffice/ListesDemandeOffres",compact("reponse"));
    }
}
