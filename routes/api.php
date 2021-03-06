<?php

use App\Http\Controllers\Api\BulkClients;
use App\Http\Controllers\Api\ClientsController;
use App\Http\Controllers\Api\GroupClientController;
use App\Http\Controllers\Api\GroupsController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SMSController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [UserController::class, 'create']);
Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function ()
{
    Route::resource('client', ClientsController::class);
    Route::resource('group', GroupsController::class);
    Route::resource('sms', SMSController::class);
    Route::resource('bulkclients', BulkClients::class);
    Route::post('groupclient',[GroupClientController::class, 'groupClient' ] );
    Route::post('smsgroup',[SMSController::class, 'smsgroup' ] );
    // Route::post('sms',[SMSController::class, 'groupClient' ] );
    Route::get('dashboard',[DashboardController::class,'dashboard']);
});