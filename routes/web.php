<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\ParcoursAdminController;
use App\Http\Controllers\Admin\NiveauAdminController;
use App\Http\Controllers\Admin\MessageAdminController;
use App\Models\Document;
use App\Models\Parcours;
use App\Models\Niveau;
use App\Models\User;
use App\Models\Message;

/*
|--------------------------------------------------------------------------
| Page d'accueil et contact
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/apropos', function () {
    return view('apropos');
})->name('apropos');

/*
|--------------------------------------------------------------------------
| Tableau de bord utilisateur
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $documentsCount = Document::count();
    $parcoursCount = Parcours::count();
    $niveauxCount = Niveau::count();
    $usersCount = User::count();

    return view('dashboard', compact(
        'documentsCount',
        'parcoursCount',
        'niveauxCount',
        'usersCount'
    ));
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes Utilisateur connecté
|--------------------------------------------------------------------------
*/
//Login and registration routes

    

Route::middleware('auth')->group(function () {
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/{id}/view', [DocumentController::class, 'view'])->name('documents.view');
    Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');

    Route::resource('parcours', ParcoursController::class);
    Route::resource('annees', AnneeController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard admin
    Route::get('/', function () {
        return view('admin.dashboard', [
            'documentsCount' => Document::count(),
            'parcoursCount'  => Parcours::count(),
            'niveauxCount'   => Niveau::count(),
            'usersCount'     => User::count(),
            'messagesCount'  => Message::count(),
        ]);
    })->name('dashboard');



    // Parcours & Niveaux
    // Route::resource('parcours', ParcoursAdminController::class);
    // Route::resource('niveaux', NiveauAdminController::class);
});
// Gestion des messages



    Route::get('/admin/messages', function () {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    })->middleware(['auth', 'is_admin'])->name('admin.messages.index');

    Route::delete('/admin/messages/{message}', function (Message $message) {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé avec succès.');
    })->middleware(['auth', 'is_admin'])->name('admin.messages.destroy');



/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
