<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParcoursController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AnneeController;
use App\Http\Middleware\Cors;

Route::middleware([Cors::class])->group(function () {

    // --- Auth API --- //
    Route::post('/register', [RegisteredUserController::class, 'storeApi']);
    Route::post('/login', [AuthenticatedSessionController::class, 'apiLogin']);

    // ✅ Routes protégées par Sanctum

    Route::post('/logout', [AuthenticatedSessionController::class, 'apiLogout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');

        // ✅ Retourne l’utilisateur connecté
        // --- Profil --- //
        Route::get('/profile', [ProfileController::class, 'apiShow']);
        Route::put('/profile', [ProfileController::class, 'apiUpdate']);
        Route::delete('/profile', [ProfileController::class, 'apiDestroy']);


    // --- Niveaux API (désactivé pour l’instant) --- //
    // Route::get('/niveaux', [AnneeController::class, 'apiIndex']);
    // Route::post('/niveaux', [AnneeController::class, 'apiStore']);
    // Route::get('/niveaux/{id}', [AnneeController::class, 'apiShow']);

    // --- Parcours API --- //
    Route::get('/parcours', [ParcoursController::class, 'apiIndex']);
    Route::post('/parcours', [ParcoursController::class, 'apiStore']);
    Route::get('/parcours/{id}', [ParcoursController::class, 'apiShow']);
    Route::put('/parcours/{id}', [ParcoursController::class, 'apiUpdate']);
    Route::delete('/parcours/{id}', [ParcoursController::class, 'apiDestroy']);

    // --- Documents API --- //
    Route::get('/documents', [DocumentController::class, 'apiIndex']);
    // Ajoute de    
    Route::post('/documents', [DocumentController::class, 'apiStore']);
    // Fonctions désactivées pour l’instant

    // Route::get('/documents/{id}', [DocumentController::class, 'apiShow']);
    // Route::put('/documents/{id}', [DocumentController::class, 'apiUpdate']);
    // Route::delete('/documents/{id}', [DocumentController::class, 'apiDestroy']);

    // --- Fichiers --- //
    Route::get('/documents/{id}/download', [DocumentController::class, 'apiDownload']);
    Route::get('/documents/{id}/view', [DocumentController::class, 'apiView']);
});
