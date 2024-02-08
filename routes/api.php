<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/contents/create',[ContentsController::class, 'createContent']);
Route::get('/contents',[ContentsController::class,'getContents']);
Route::get('/contents/{page}',[ContentsController::class,'getPageContent']);
Route::get('/contents/image/{filename}',[ContentsController::class,'getImage']);
