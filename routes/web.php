<?php

use App\Models\Visiteur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\DemandeoffresController;
use App\Http\Controllers\AdministrateurController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/Recruteur', function () {
    return view('auth/login');
});
//Login Enqueteurs
Route::get('/', function () {
    return view('FrontOffice/LoginEnqueteur');
});
Route::get('/LoginCandidats', function(){
    return view('FrontOffice/LoginEnqueteur');
})->name('LoginCandidats');

Route::get('/login', function(){
    return view('auth/login');
})->name('login');

// Back Office
// demande Ajout Offre
Route::get('DemandeOffres',[DemandeoffresController::class, "demandeOffre"])->name("DemandeOffres");

Route::post('traitementdemandeoffre',[DemandeoffresController::class, 'store'])->name("traitementdemandeoffre");

Route::get('ListesDemandeAjoutoffre',[DemandeoffresController::class, "listeDemande"])->middleware(['auth'])->name("ListesDemandeAjoutoffre");

//comptes administrateurs
Route::get('Comptes',[BackController::class, 'listesAdministrateurs'])->middleware(['auth'])->name("Comptes");
// Route::get('deletecomptes/{id}', [BackController::class, 'supprimerComptes'])->middleware(['auth'])->name("deletecomptes/{id}");
Route::post('deletecomptes/{id}', [BackController::class, 'supprimerComptes'])->middleware(['auth'])->name("deletecomptes/{id}");
Route::get('Modificationstatus',[BackController::class, 'modificationstatusAdmin'])->middleware(['auth'])->name("Modificationstatus");
Route::get('Fiche',[BackController::class, 'ficheAdmin'])->middleware(['auth'])->name("Fiche");
Route::get('/AjoutAdministrateurs',[BackController::class, "listes"])->middleware(['auth'])->name("AjoutAdministrateurs");
Route::post('traitementAdmin',[BackController::class,'fonctionajoutAdmin'])->name("traitementAdmin");


Route::get('/Acceuil', [OffreController::class, 'listesOffres'])->middleware(['auth'])->name('Acceuil');

// Offres
Route::get('/AjoutOffres',[OffreController::class,'PageAjoutOffre'])->middleware(['auth'])->name("AjoutOffres");
Route::post('traitementOffre',[OffreController::class,'ajoutOffre'])->middleware(['auth'])->name("traitementOffre");
Route::get('/visiteur',[VisiteurController::class,'store']);

// ModificationOffres
Route::get('ModificationOffre',[OffreController::class,'pageModificationOffre'])->middleware(['auth'])->name("ModificationOffre");
Route::post('traitementModificationOffre',[OffreController::class,'traitementModificationOffre'])->middleware(['auth'])->name("traitementModificationOffre");
Route::get('ModificationStatusOffres',[OffreController::class,'traitementModificationStatus'])->middleware(['auth'])->name("ModificationStatusOffres");

Route::get('ModificationAccesOffres',[OffreController::class,'ModificationEtatAccesOffre'])->middleware(['auth'])->name("ModificationAccesOffres");

Route::get('DetailsOffres',[BackController::class,'listesDesAgentsEnqueteurs'])->middleware(['auth'])->name("DetailsOffres");
Route::get('DownloadFichier',[BackController::class,'downloadfile'])->middleware(['auth'])->name("DownloadFichier");
Route::get('FiltreParRegion',[BackController::class,'RechercherParRegion'])->middleware(['auth'])->name("FiltreParRegion");
Route::post('ExportExcelEnqueteurs',[BackController::class,'TraitementExportExcel'])->middleware(['auth'])->name("ExportExcelEnqueteurs");
Route::get('DownloadImage',[BackController::class,'downloadphoto'])->middleware(['auth'])->name("DownloadImage");

//Front-Office
Route::post('traitementLogin',[FrontController::class,"traitementLoginEnqueteur"])->name("traitementLogin");

Route::get('inscription', function(){
    return view('FrontOffice/Inscription');
})->name('inscription');
Route::post('TraitementInscription',[FrontController::class,"traitementInscription"])->name("TraitementInscription");
// Deconnexion
Route::get('DeconnexionFront',[FrontController::class,"deconnexionEnqueteur"])->name("DeconnexionFront");

Route::get('/ListesOffres',[FrontController::class, "listesOffres"])->name("ListesOffres");

Route::get('/formulaireOffres',[FrontController::class, "getFormulairesOffres"])->name("formulaireOffres");

Route::get('/DetailsOffre',[FrontController::class, "traitementDetailsOffres"])->name("DetailsOffre");

Route::post('/traitementEnqueteurs',[FrontController::class, "traitementPostuleEnqueteurs"])->name("traitementEnqueteurs");
Route::get('Historiques',[FrontController::class, "traitementHistoriques"])->name("Historiques");
Route::get('ProfilUtilisateur',[FrontController::class, "traitementProfilUtilisateur"])->name("ProfilUtilisateur");



Route::post('ModificationProfilUtilisateur',[FrontController::class, "traitementModificationProfil"])->name("ModificationProfilUtilisateur");
Route::post('ModificationMotDePasse',[FrontController::class, "modificationMotDepasseEnqueteur"])->name("ModificationMotDePasse");
require __DIR__.'/auth.php';
