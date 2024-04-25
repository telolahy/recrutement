<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Visiteur;
use Illuminate\Http\Request;

class VisiteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
        $offre=Offre::get('id');
        $visiteur= new Visiteur();
        $visiteur->offre_id=$offre;
        $visiteur->nombreVisiteurs=$request->input('nombreVisiteurs');
    
        $visiteur->save();

       dd($visiteur);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visiteur  $visiteur
     * @return \Illuminate\Http\Response
     */
    public function show(Visiteur $visiteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visiteur  $visiteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Visiteur $visiteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visiteur  $visiteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visiteur $visiteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visiteur  $visiteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visiteur $visiteur)
    {
        //
    }
}
