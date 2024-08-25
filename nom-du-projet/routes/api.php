<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\StoreKeeperController;

route::post("/register",[UserController::class,"register"]);

Route::post('/login', [UserController::class, 'login']);
Route::get('/getProfilById/{id}', [UserController::class, 'getProfilById']);
Route::put('/update_user_profil/{id}', [UserController::class, 'updateUserProfil']);
Route::get('/users/new', [UserController::class, 'NewUser']);



//route admin

Route::delete('/admin/users/delete/{id}', [AdminController::class, 'destroy']);

Route::apiResource('articles', ArticleController::class);


Route::apiResource('store_keepers', StoreKeeperController::class);




/* Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy']);
    Route::get('admin/users/new', [UserController::class, 'NewUser']);
}); */