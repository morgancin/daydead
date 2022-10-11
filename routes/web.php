<?php

use Illuminate\Http\Response;

//use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
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

/////////////DOWNLOAD FILE
Route::get('download/{path}/{attachment}', function($path, $attachment) {
    return response()->download(storage_path("app/public/$path/$attachment"));
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/leads', [LeadController::class, 'index'])->name('leads');
//Route::get('/leads/register/{hash}', [LeadController::class, 'create'])->name('leads.register');
//Route::post('/leads/register', [LeadController::class, 'store'])->name('leads.register.store');

//Route::get('/qrs/register', [QrController::class, 'create'])->name('qrs.register');
//Route::post('/qrs/register', [QrController::class, 'store'])->name('qrs.register.store');

//Route::get('places', [PlaceController::class, 'index'])->name('places');
//Route::post('places', [PlaceController::class, 'index'])->name('places.post');
//Route::get('places/register', [PlaceController::class, 'create'])->name('places.register');
//Route::post('places/register', [PlaceController::class, 'store'])->name('places.register.store');
//Route::get('/users', [UserController::class, 'index'])->name('users');
//Route::post('/users', [UserController::class, 'index'])->name('users.post');
//Route::get('/users/register', [UserController::class, 'create'])->name('users.register');
//Route::post('/users/register', [UserController::class, 'store'])->name('users.store');

Route::group(['prefix' => "leads"], function()
{
    Route::controller(LeadController::class)->group(function ()
    {
        Route::get('/', 'index')->name('leads');
        Route::post('/', 'index')->name('leads.post');
        Route::put('/update', 'update')->name('leads.update');
        Route::post('/register', 'store')->name('leads.store');
        Route::get('/update/{user}', 'edit')->name('leads.edit');
        Route::delete('/delete', 'destroy')->name('leads.delete');
        Route::get('/register/{hash}', 'create')->name('leads.register');
    });
});

Route::group(['prefix' => "users"], function()
{
    Route::controller(UserController::class)->group(function ()
    {
        Route::get('/', 'index')->name('users');
        Route::post('/', 'index')->name('users.post');
        Route::put('/update', 'update')->name('users.update');
        Route::post('/register', 'store')->name('users.store');
        Route::get('/update/{user}', 'edit')->name('users.edit');
        Route::delete('/delete', 'destroy')->name('users.delete');
        Route::get('/register', 'create')->name('users.register');
    });
});

Route::group(['prefix' => "qrs"], function()
{
    Route::controller(QrController::class)->group(function ()
    {
        Route::get('/', 'index')->name('qrs');
        Route::post('/', 'index')->name('qrs.post');
        Route::delete('/delete', 'destroy')->name('qrs.delete');
        Route::get('/register', 'create')->name('qrs.register');
        Route::post('/register', 'store')->name('qrs.register.store');
    });
});

Route::group(['prefix' => "places"], function()
{
    Route::controller(PlaceController::class)->group(function ()
    {
        Route::get('/', 'index')->name('places');
        Route::post('/', 'index')->name('places.post');
        Route::put('/update', 'update')->name('places.update');
        Route::get('/update/{place}', 'edit')->name('places.edit');
        Route::delete('/delete', 'destroy')->name('places.delete');
        Route::get('/register', 'create')->name('places.register');
        Route::post('/register', 'store')->name('places.register.store');
    });
});

require __DIR__.'/auth.php';
