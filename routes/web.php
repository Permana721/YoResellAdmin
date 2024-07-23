<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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

Route::get('/login', [MemberController::class, 'login'])->name('login');
Route::get('/logout', [MemberController::class, 'logout'])->name('logout');
Route::get('/register', [MemberController::class, 'register']);
Route::post('/regpros', [MemberController::class, 'regpros'])->name('regpros');
Route::post('/logpros', [MemberController::class, 'logpros'])->name('logpros');


Route::middleware('login')->group(function () {
    Route::get('/home', [MemberController::class, 'index'])->name('home');
    Route::fallback(function () {
        return redirect()->route('home');
    });
    Route::get('/store', [MemberController::class, 'store'])->name('store');
});