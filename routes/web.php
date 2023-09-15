<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductImportController;

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

Route::get('import', [ProductImportController::class, 'index'])->name('import.index');
Route::post('import', [ProductImportController::class, 'store'])->name('import.store');

