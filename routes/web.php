<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

Route::get('/register', [userController::class, 'registration_form'])->name('register');
Route::post('/register', [userController::class, 'registration']);

Route::get('/login', [userController::class, 'login_form'])->name('login_form');
Route::post('/login', [userController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [userController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [userController::class, 'logout'])->name('logout');
});