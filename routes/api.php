<?php

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

Route::post('/uploud', [App\Http\Controllers\ApiControllers::class, 'sendData']);
Route::post('/getKaryawan', [App\Http\Controllers\ApiControllers::class, 'getkarywan']);

// api utuk website finace
Route::post('/getGaji', [App\Http\Controllers\ApiControllers::class, 'getDataAproval']);
Route::post('/syncGaji', [App\Http\Controllers\ApiControllers::class, 'syncGaji']);
Route::post('/getImg', [App\Http\Controllers\ApiControllers::class, 'getImgProfile']);
Route::post('/getProfile', [App\Http\Controllers\ApiControllers::class, 'getProfile']);
Route::get('/getDivisi', [App\Http\Controllers\ApiControllers::class, 'divisi']);
