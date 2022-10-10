<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PlaceController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('leads/register', [LeadController::class, 'create'])->name('leads.register');
Route::post('leads/register', [LeadController::class, 'store'])->name('leads.register.store');

Route::get('qrs/register', [QrController::class, 'create'])->name('qrs.register');
Route::post('qrs/register', [QrController::class, 'store'])->name('qrs.register.store');

Route::get('places/register', [PlaceController::class, 'create'])->name('places.register');
Route::post('places/register', [PlaceController::class, 'store'])->name('places.register.store');

require __DIR__.'/auth.php';
