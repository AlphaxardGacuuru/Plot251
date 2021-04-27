<?php

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

Route::redirect('/', 'water-readings');

Auth::routes();

Route::resources([
    'apartment' => 'UsersController',
    'water-readings' => 'WaterReadingsController',
    'water-payments' => 'WaterPaymentsController',
]);
