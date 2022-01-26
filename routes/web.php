<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/getDeliveries', [DeliveryController::class, 'getDeliveries'])->name('getDeliveries');

Route::get('/getClients', [UserController::class, 'getClients'])->name('getClients');
Route::get('/getDelivers', [UserController::class, 'getDelivers'])->name('getDelivers');

Route::get('/getStatus', [StatusController::class, 'getStatus'])->name('getStatus');

Route::post('/storeDelivery', [DeliveryController::class, 'storeDelivery'])->name('storeDelivery');

Route::put('/updateDelivery/{delivery}', [DeliveryController::class, 'updateDelivery'])->name('updateDelivery');
Route::put('/updateStatusDelivery/{delivery}', [DeliveryController::class, 'updateStatusDelivery'])->name('updateStatusDelivery');
Route::put('/updateDeliverDelivery/{delivery}', [DeliveryController::class, 'updateDeliverDelivery'])->name('updateDeliverDelivery');
