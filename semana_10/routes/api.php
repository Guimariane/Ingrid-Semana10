<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('clients', [ClientController::class, 'index']);
Route::post('clients', [ClientController::class, 'store']);
Route::delete('clients/{id}', [ClientController::class, 'destroy']);
Route::put('clients/{id}', [ClientController::class, 'update']);
