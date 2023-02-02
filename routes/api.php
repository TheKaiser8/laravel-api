<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// creo rotta (/api/projects) che restituisca tutti i dati dei progetti in formato JSON
Route::get('projects', [ProjectController::class, 'index']);

// rotta /api/projects/et-quae-nostrum-quas-ea-ipsam-iure (slug d'esempio)
Route::get('projects/{slug}', [ProjectController::class, 'show']);
