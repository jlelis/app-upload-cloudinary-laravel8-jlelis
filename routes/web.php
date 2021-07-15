<?php

use App\Http\Controllers\FileUploadController;
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

Route::get('/upload', [FileUploadController::class,'showUploadForm']);
Route::post('/upload',  [FileUploadController::class,'storeUploads']);

Route::get('/', function () {
    return view('upload');
});
