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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentification utilisateur
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt'); // <-- Ity no antsoina ao amin'ny form
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Tableau de bord
Route::get('/', [DashController::class, 'show'])->name('dashboard');


// ======= GESTION DES VOITURES =======
Route::get('/voiture/liste', [VoitureController::class,"showVoiture"])->name('voiture');

// ajout



Route::get('/voiture/ajouter', [AjoutVoitureController::class, 'create'])->name('voiture.ajout');
Route::post('/voiture/ajoutVoiture', [AjoutVoitureController::class, 'store'])->name('voiture.store');
Route::put('/voiture/{id}', [AjoutVoitureController::class, 'update'])->name('voiture.update');



Route::get('/voiture/{id}', [AjoutVoitureController::class,"delete"])->name('voiture.delete');

// verification


Route::get('/verifications', [VerifVoitureController::class, 'index'])->name('verification.index');
Route::get('/verification/formulaire', [VerifVoitureController::class, 'verification'])->name('verification.form');
Route::post('/verification/store', [VerifVoitureController::class, 'verif'])->name('verification.store');
Route::get('/verification/{id}', [VerifVoitureController::class, 'delete'])->name('verification.delete');

// ======= AUTHENTIFICATION CHAUFFEUR =======
Route::get('/authChauffeur', [DetailChaufController::class,"create"])->name('Authentification.chauffeur');
Route::post('/loginChauffeur',[DetailChaufController::class,"login"])->name('login.chauffeur');
Route::post('/registerChauffeur',[DetailChaufController::class,"register"])->name('register.chauffeur');


// ======= Trajet =======
Route::get('/trajet', [TrajetController::class, 'create'])->name('trajet.create');
Route::post('/trajet', [TrajetController::class, 'store'])->name('trajet.store');
Route::get('/trajet/{id}', [TrajetController::class, 'destroy'])->name('trajet.destroy');


Route::post('/trajet/distance', [TrajetController::class, 'getDistance'])->name('trajet.distance');





