<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\DetailChaufController;
use App\Http\Controllers\AjoutVoitureController;
use App\Http\Controllers\VerifVoitureController;
use App\Http\Controllers\TabBordController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\ConsommationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======= AUTHENTIFICATION =======
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ======= DASHBOARD =======
Route::get('/', [DashController::class, 'show'])->name('dashboard');
Route::get('/gestionRole', [DashController::class, 'GestionRole'])->name('gestionRole');
Route::put('/gestionRole/{id}', [DashController::class, 'updateRole'])->name('gestionRole.update');


// ======= GESTION DES VOITURES =======
Route::get('/voiture/liste', [VoitureController::class,"showVoiture"])->name('voiture');

// ======= AJOUT DES VOITURES =======
Route::get('/voiture/ajouter', [AjoutVoitureController::class, 'create'])->name('voiture.ajout');
Route::post('/voiture/ajoutVoiture', [AjoutVoitureController::class, 'store'])->name('voiture.store');
Route::put('/voiture/{id}', [AjoutVoitureController::class, 'update'])->name('voiture.update');
// ======= SUPPRESION DES VOITURE =======
Route::get('/voiture/{id}', [AjoutVoitureController::class,"delete"])->name('voiture.delete');

// ======= VERIFICATION DES VOITURES =======
Route::get('/verifications', [VerifVoitureController::class, 'index'])->name('verification.index');
Route::get('/verification/formulaire', [VerifVoitureController::class, 'verification'])->name('verification.form');
Route::post('/verification/store', [VerifVoitureController::class, 'verif'])->name('verification.store');
Route::get('/verification/{id}', [VerifVoitureController::class, 'delete'])->name('verification.delete');

// ======= AUTHENTIFICATION CHAUFFEUR =======
Route::get('/authChauffeur', [DetailChaufController::class,"create"])->name('Authentification.chauffeur');
Route::post('/loginChauffeur',[DetailChaufController::class,"login"])->name('login.chauffeur');
Route::post('/registerChauffeur',[DetailChaufController::class,"register"])->name('register.chauffeur');

// ======= PROFIL CHAUFFEUR =======
Route::get('/profilChauffeur', [DetailChaufController::class, 'showProfilChauffeur'])->name('profil.chauffeur');
Route::post('/profilChauffeur', [DetailChaufController::class, 'storeProfilChauffeur'])->name('profil.chauffeur.store');
Route::get('/profilChauffeur/edit', [DetailChaufController::class, 'editProfil'])->name('profil.chauffeur.edit');
Route::put('/profilChauffeur/update/{id}', [DetailChaufController::class, 'updateProfilChauffeur'])->name('profil.chauffeur.update');

// ======= TRAJET =======
Route::get('/trajet', [TrajetController::class, 'create'])->name('trajet.create');
Route::post('/trajet', [TrajetController::class, 'store'])->name('trajet.store');
Route::get('/trajet/{id}', [TrajetController::class, 'destroy'])->name('trajet.destroy');

// ======= MISSION =======
Route::get('/mission', [MissionController::class, 'showMission'])->name('mission.show');
Route::post('/mission', [MissionController::class, 'mission'])->name('mission.store');
Route::post('/disponibilites', [MissionController::class, 'checkDisponibilite'])->name('check.disponibilite');

Route::get('/mission/{id}', [MissionController::class, 'delete'])->name('mission.delete');

// ======= Tableau de bord =======
Route::get('/tabbord/liste', [TabBordController::class, 'index'])->name('tabbord.index');
Route::get('/tabbords', [TabBordController::class, 'create'])->name('tabbord.create');
Route::post('/tabbord', [TabBordController::class, 'store'])->name('tabbord.store');
Route::get('/tabbord/{id}', [TabBordController::class, 'destroy'])->name('tabbord.destroy');
Route::get('/chauffeurs', [ChauffeurController::class, 'index'])->name('chauffeur.index');

// ======= CARBURANT =======
Route::get('/carburants', [ConsommationController::class, 'create'])->name('consommation');
Route::get('/carburant', [ConsommationController::class, 'store'])->name('consommation.store');






