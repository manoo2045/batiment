<?php

use App\Http\Controllers\MaisonController;
use App\Http\Controllers\Traveaux_clientController;
use App\Http\Controllers\TraveauxController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('client/login');
});

Route::get('/insertAd',[\App\Http\Controllers\AuthController::class,'insertAd']);
Route::get('/insertCli',[\App\Http\Controllers\AuthController::class,'inscription']);

Route::get('/admin/login',[\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
Route::get('/client/login',[\App\Http\Controllers\AuthController::class,'loginClient']);

Route::post('/admin/login',[\App\Http\Controllers\AuthController::class,'doLogin'])->name('auth.doLogin');
Route::post('/client/login',[\App\Http\Controllers\AuthController::class,'doLoginClient'])->name('auth.doLoginClient');

Route::get('/register',[\App\Http\Controllers\AuthController::class,'register'])->name('auth.register');
Route::post('/client/register',[\App\Http\Controllers\AuthController::class,'doRegister']);

Route::get('/logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');

Route::middleware('admin')->group(function () {
    Route::get('/home', [\App\Http\Controllers\AccueilAdmin::class, 'home']);
    Route::get('/admin/clearBd', [\App\Http\Controllers\AccueilAdmin::class, 'clearBd']);
    Route::get('/finition/', [\App\Http\Controllers\AccueilAdmin::class, 'clearBd']);
    Route::post('/admin/histogramme', [\App\Http\Controllers\StatistiqueController::class, 'getHistograme']);
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashBoard::class, 'index']);
    Route::get('/admin/devis/liste',[\App\Http\Controllers\DevisController::class,'listeDevisEnCour']);
    Route::get('/devis/detail/{ref}',[\App\Http\Controllers\DevisController::class,'detailDevis']);
    Route::get('/finition/liste',[\App\Http\Controllers\ModifController::class,'finition']);
    Route::post('/finition/edite',[\App\Http\Controllers\ModifController::class,'finitionEdit'])->name('finition.edit');
    Route::get('/import',[\App\Http\Controllers\ImportController::class,'index']);
    Route::post('/import/traveauxMaison',[\App\Http\Controllers\ImportController::class,'inportMaisonTraveaux']);
    Route::post('/import/paiment',[\App\Http\Controllers\ImportController::class,'importPayment']);

    Route::get('/travaux/liste',[\App\Http\Controllers\ModifController::class,'travaux']);
    Route::get('/travaux/edite/{id}',[\App\Http\Controllers\ModifController::class,'formEdit']);
    Route::post('/travaux/doedite',[\App\Http\Controllers\ModifController::class,'travauxEdit'])->name('traveaux.edite');
});

Route::prefix('client')->middleware('client')->group(function () {
    Route::get('/home',[\App\Http\Controllers\AcceilClient::class,'home']);
    Route::get('/devis/creer',[\App\Http\Controllers\DevisController::class,'viewDemandeDevis']);
    Route::post('/devis/demande',[\App\Http\Controllers\DevisController::class,'demandeDevis']);
    Route::post('/devis/payment',[\App\Http\Controllers\PaymentController::class,'paymentDevis']);
    Route::get('/devis/liste',[\App\Http\Controllers\DevisController::class,'listeDevis']);
    Route::get('/devis/payment/{ref}',[\App\Http\Controllers\PaymentController::class,'loadView']);

    Route::get('/devis/export/{ref}',[\App\Http\Controllers\ImportController::class,'exportDevis']);
    Route::get('/map',[\App\Http\Controllers\AcceilClient::class,'map']);
});

//Route::get('/devis/liste',[\App\Http\Controllers\DevisController::class,'detailDevis']);
Route::get('/devis',[\App\Http\Controllers\DevisController::class,'demandeDevis']);


Route::get('/maison',[MaisonController::class,'list']);
Route::get('/maison/list/',[MaisonController::class,'list']);
Route::post('/maison/insert',[MaisonController::class,'insert']);
Route::get('/maison/edit/{id}',[MaisonController::class,'maisonEditView']);
Route::post('/maison/update',[MaisonController::class,'maisonEdit']);
Route::get('/maison/delete/{id}',[MaisonController::class,'delete']);

Route::get('/traveaux',[TraveauxController::class,'list']);
Route::get('/traveaux/list/',[TraveauxController::class,'list']);
Route::post('/traveaux/insert',[TraveauxController::class,'insert']);
Route::get('/traveaux/edit/{id}',[TraveauxController::class,'traveauxEditView']);
Route::post('/traveaux/update',[TraveauxController::class,'traveauxEdit']);
Route::get('/traveaux/delete/{id}',[TraveauxController::class,'delete']);

Route::get('/traveaux_client',[Traveaux_clientController::class,'list']);
Route::get('/traveaux_client/list/',[Traveaux_clientController::class,'list']);
Route::post('/traveaux_client/insert',[Traveaux_clientController::class,'insert']);
Route::get('/traveaux_client/edit/{id}',[Traveaux_clientController::class,'traveaux_clientEditView']);
Route::post('/traveaux_client/update',[Traveaux_clientController::class,'traveaux_clientEdit']);
Route::get('/traveaux_client/delete/{id}',[Traveaux_clientController::class,'delete']);

Route::get('/time',[\App\Http\Controllers\TimeController::class,'index']);
