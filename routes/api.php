<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ArtGalleryController;
use App\Http\Controllers\ArtworkController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ExhibitionArtworkController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParticipantController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);

Route::get('/artists', [ArtistController::class, 'index']);
Route::get('/artists/{id}', [ArtistController::class, 'show']);
Route::post('/artists', [ArtistController::class, 'store']);
Route::put('/artists/{id}', [ArtistController::class, 'update']);
Route::delete('/artists/{id}',[ArtistController::class, 'destroy']);

Route::get('/art-galleries', [ArtGalleryController::class, 'index']);
Route::get('/art-galleries/{id}', [ArtGalleryController::class, 'show']);
Route::post('/art-galleries', [ArtGalleryController::class, 'store']);
Route::post('/art-galleries/{id}', [ArtGalleryController::class, 'update']);
Route::post('/art-galleries/{id}', [ArtGalleryController::class, 'destroy']);

Route::post('/artworks/{id}', [ArtworkController::class, 'index']);
Route::post('/artworks/{id}', [ArtworkController::class, 'show']);
Route::post('/artworks', [ArtworkController::class, 'store']);
Route::post('/artworks/{id}', [ArtworkController::class, 'update']);
Route::post('/artworks/{id}', [ArtworkController::class, 'destroy']);

Route::get('/exhibitions', [ExhibitionController::class, 'index']);
Route::get('/exhibitions/{id}', [ExhibitionController::class, 'show']);
Route::post('/exhibitions', [ExhibitionController::class, 'store']);
Route::put('/exhibitions/{id}', [ExhibitionController::class, 'update']);
Route::delete('/exhibitions/{id}', [ExhibitionController::class, 'destroy']);

// Exhibition artwork routes
Route::get('/exhibition-artworks', [ExhibitionArtworkController::class, 'index']);
Route::get('/exhibition-artworks/{id}', [ExhibitionArtworkController::class, 'show']);
Route::post('/exhibition-artworks', [ExhibitionArtworkController::class, 'store']);
Route::delete('/exhibition-artworks/{id}', [ExhibitionArtworkController::class, 'destroy']);

// Conversation routes
Route::get('/conversations', [ConversationController::class, 'index']);
Route::get('/conversations/{id}', [ConversationController::class, 'show']);
Route::post('/conversations', [ConversationController::class, 'store']);
Route::put('/conversations/{id}', [ConversationController::class, 'update']);
Route::delete('/conversations/{id}', [ConversationController::class, 'destroy']);

// Participant routes
Route::get('/participants', [ParticipantController::class, 'index']);
Route::get('/participants/{id}', [ParticipantController::class, 'show']);
Route::post('/participants', [ParticipantController::class, 'store']);
Route::delete('/participants/{id}', [ParticipantController::class, 'destroy']);

// Message routes
Route::get('/messages', [MessageController::class, 'index']);
Route::get('/messages/{id}', [MessageController::class, 'show']);
Route::post('/messages', [MessageController::class, 'store']);
Route::put('/messages/{id}', [MessageController::class, 'update']);
Route::delete('/messages/{id}', [MessageController::class, 'destroy']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json([
        'message' => 'DLSV API is working!'
    ]);
});

