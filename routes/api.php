<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\DestinationImagesController;
use App\Http\Controllers\DestinationsController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\TrialFormController;

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
Route::get('/destinations/all',[DestinationsController::class, 'getAllDestinations']);
Route::get('/destinations/image/{filename}', [DestinationsController::class, 'getDestinationImage']);
Route::get('/destination/{id}',[DestinationsController::class,'getDestination']);
Route::post('/destination/update',[DestinationsController::class, 'editDestination']);
Route::delete('/destination/delete/{id}',[DestinationsController::class, 'deleteDestination']);
Route::post('/destination/upload/image',[DestinationImagesController::class, 'uploadImages']);
Route::get('/destination/images/{id}',[DestinationImagesController::class,'getImages']);

Route::post('/plans/create',[PlansController::class, 'createPlan']);
Route::get('/plans',[PlansController::class, 'getPlans']);
Route::get('/plan/{id}',[PlansController::class, 'getPlanRequest']);

Route::post('/contact/create',[ContactsController::class,'createContact']);
Route::get('/contacts',[ContactsController::class, 'getContacts']);
Route::get('/contact/{id}',[ContactsController::class, 'getContactDetail']);

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {{
Route::get('/user',[AuthController::class,'user']);
Route::post('/user/logout',[AuthController::class, 'logout']);
}
});
