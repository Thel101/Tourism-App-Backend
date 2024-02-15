<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\DestinationsController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/contents/create',[ContentsController::class, 'createContent']);
Route::get('/contents',[ContentsController::class,'getContents']);
Route::get('/contents/{page}',[ContentsController::class,'getPageContent']);
Route::get('/content/{id}',[ContentsController::class, 'getContent']);
Route::get('/contents/image/{filename}',[ContentsController::class,'getImage']);
Route::post('/content/update',[ContentsController::class, 'editContent']);
Route::delete('/content/delete/{id}',[ContentsController::class, 'deleteContent']);
Route::post('/content/slot/status/{id}',[ContentsController::class, 'changeSlotStatus']);

Route::post('/destinations/create',[DestinationsController::class, 'createDestination']);
Route::get('/destinations',[DestinationsController::class, 'getDestinations']);
Route::get('/destinations/image/{filename}', [DestinationsController::class, 'getDestinationImage']);
Route::get('/destination/{id}',[DestinationsController::class,'getDestination']);
Route::post('/destination/update',[DestinationsController::class, 'editDestination']);
Route::delete('/destination/delete/{id}',[DestinationsController::class, 'deleteDestination']);
