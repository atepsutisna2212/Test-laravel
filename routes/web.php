<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
    // return view('welcome');
    return view('login');
})->name('login');


Route::get('/dashboard', function () {
    // return view('welcome');
    return view('dashboard');
})->middleware('jwt.auth');
// });
// Route::middleware(['web', 'auth'])->group(function () {
