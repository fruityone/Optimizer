<?php

use App\Http\Controllers\JsonReport\JsonReportController;
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
Route::pattern('id', '[0-9]+');

Route::get('/',[\App\Http\Controllers\Home\HomePageController::class,'view'])->name('view-home-page');
Route::get('/view-update-json-report',[JsonReportController::class,'viewUpdate'])->name('view-update-json-report');
Route::get('/admin/view-reports',[JsonReportController::class,'view'])->name('view-reports');
Route::get('/delete-json-report/{id}',[JsonReportController::class,'delete'])->name('delete');
Route::get('/login', function () {
    return view('home',['method'=>'post']);
})->name('login');

