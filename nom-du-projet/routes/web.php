<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

// Route pour l'enregistrement d'un utilisateur
Route::post("/register", [UserController::class, 'register'])->middleware("auth:sanctum");

Route::get("/r",function(){
    return "bien";
})













?>