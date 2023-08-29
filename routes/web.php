<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\PostController as PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Qui è possibile registrare le rotte web per la tua applicazione. Queste
| rotte vengono caricate dal RouteServiceProvider e tutte saranno assegnate al gruppo di middleware "web".
| Crea qualcosa di fantastico!
|
*/

// Rotta principale, mostra la vista "welcome"
Route::get('/', function () {
    return view('welcome');
});

// Esempio di rotta protetta da autenticazione e verifica email
// Questa rotta è attualmente commentata
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

// Definizione delle rotte per l'area amministrativa utilizzando un controller
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
});

// Rotte relative al profilo dell'utente, protette da autenticazione
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Richiede le rotte di autenticazione predefinite fornite da Laravel
require __DIR__.'/auth.php';




