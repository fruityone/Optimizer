<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\JsonReport\JsonReportController;
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
Route::pattern('id', '[0-9]+');

Route::post('login',[AuthController::class,'login']);
Route::match(['get','post'],'/post-json-report',[JsonReportController::class,'save'])->name('save-json-report');
Route::match(['get','post'],'/update-json-report',[JsonReportController::class,'update'])->name('update-json-report');
Route::middleware('auth:api')->group(function(){
    Route::get('/user',function(Request $request){
        return $request->user();
    })->name('user');
});
//
//Route::middleware('auth:api')->group(function(){
//
//});
