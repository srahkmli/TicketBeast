<?php

use App\Http\Controllers\ConcertController;
use App\Http\Controllers\ConcertOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/concerts/{id}', [ConcertController::class, 'show']);

Route::post('/concerts/{id}/orders', [ConcertOrderController::class, 'store']);
