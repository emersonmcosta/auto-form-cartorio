<?php

use App\Http\Controllers\GateController;
use App\Http\Controllers\Forms\FormularioNTAbandonoEmprego;
use App\Http\Controllers\Forms\FormularioNTCobrancaDividasController;
use App\Http\Controllers\Forms\FormularioNTDesocupacaoVoluntariaImovel;
use App\Http\Controllers\Forms\FormularioConstituicaoAssociacaoController;
use App\Http\Controllers\Forms\FormularioConstituicaoSociedadeSimplesController;
use App\Http\Controllers\Forms\FormularioAssembleiaCondominioController;
use App\Http\Controllers\Forms\FormularioConstituicaoSociedadeSimplesUnipessoalController;
use App\Http\Controllers\Forms\GuardaAnimalController;
use App\Http\Controllers\Forms\GuardaAnimalCompartilhadaController;
use App\Http\Controllers\Forms\FormularioNTRecisaoContratoImovel;
use App\Http\Controllers\Forms\FormularioNTRevogacaoProcuracao;
use App\Http\Controllers\Forms\FormularioNTTextoLivre;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('main');
})->name('main');

Route::prefix('RCPJ')->group(function () {
    Route::get('/', [GateController::class, 'rcpj']);

    Route::get('constituicao-associacao', [FormularioConstituicaoAssociacaoController::class, 'index'])->name('constituicao-associacao');
    Route::post('constituicao-associacao', [FormularioConstituicaoAssociacaoController::class, 'createDocument']);

    Route::get('constituicao-sociedade-simples', [FormularioConstituicaoSociedadeSimplesController::class, 'index'])->name('constituicao-sociedade-simples');
    Route::post('constituicao-sociedade-simples', [FormularioConstituicaoSociedadeSimplesController::class, 'createDocument']);

    Route::get('constituicao-sociedade-simples-unipessoal', [FormularioConstituicaoSociedadeSimplesUnipessoalController::class, 'index'])->name('constituicao-sociedade-simples-unipessoal');
    Route::post('constituicao-sociedade-simples-unipessoal', [FormularioConstituicaoSociedadeSimplesUnipessoalController::class, 'createDocument']);
});
Route::prefix('RTD')->group(function () {
    Route::get('/', [GateController::class, 'rtd']);
    Route::get('assembleia-de-condominio', [FormularioAssembleiaCondominioController::class, 'index'])->name('assembleia-de-condominio');
    Route::post('assembleia-de-condominio', [FormularioAssembleiaCondominioController::class, 'createDocument']);
});

Route::prefix('PET')->group(function () {
    Route::get('/', [GateController::class, 'pet']);
    Route::get('guarda-individual-animal-domestico', [GuardaAnimalController::class, 'index'])->name('guarda-individual-animal-domestico');
    Route::post('guarda-individual-animal-domestico', [GuardaAnimalController::class, 'createDocument']);

    Route::get('guarda-individual-animal-domestico-compartilhada', [GuardaAnimalCompartilhadaController::class, 'index'])->name('guarda-individual-animal-domestico-compartilhada');
    Route::post('guarda-individual-animal-domestico-compartilhada', [GuardaAnimalCompartilhadaController::class, 'createDocument']);
});
Route::prefix('NT')->group(function () {
    Route::get('/', [GateController::class, 'nt']);

    Route::get('NT-CDD', [FormularioNTCobrancaDividasController::class, 'index'])->name('NT-CDD');
    Route::post('NT-CDD', [FormularioNTCobrancaDividasController::class, 'createDocument']);

    Route::get('NT-ADE', [FormularioNTAbandonoEmprego::class, 'index'])->name('NT-ADE');
    Route::post('NT-ADE', [FormularioNTAbandonoEmprego::class, 'createDocument']);

    Route::get('NT-DVBI', [FormularioNTDesocupacaoVoluntariaImovel::class, 'index'])->name('NT-DVBI');
    Route::post('NT-DVBI', [FormularioNTDesocupacaoVoluntariaImovel::class, 'createDocument']);

    Route::get('NT-RDP', [FormularioNTRevogacaoProcuracao::class, 'index'])->name('NT-RDP');
    Route::post('NT-RDP', [FormularioNTRevogacaoProcuracao::class, 'createDocument']);

    Route::get('NT-RLI', [FormularioNTRecisaoContratoImovel::class, 'index'])->name('NT-RLI');
    Route::post('NT-RLI', [FormularioNTRecisaoContratoImovel::class, 'createDocument']);

    Route::get('NT-TL', [FormularioNTTextoLivre::class, 'index'])->name('NT-TL');
    Route::post('NT-TL', [FormularioNTTextoLivre::class, 'createDocument']);
});


Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//auth routes  
require __DIR__.'/auth.php';