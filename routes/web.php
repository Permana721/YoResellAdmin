<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StoreController;
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

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/register', [HomeController::class, 'register']);
Route::post('/regpros', [HomeController::class, 'regpros'])->name('regpros');
Route::post('/logpros', [HomeController::class, 'logpros'])->name('logpros');

Route::middleware('login')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::fallback(function () {
        return redirect()->route('home');
    });

    Route::get('/catalog', [StoreController::class, 'index'])->name('catalog');
    Route::get('/transaction-store', [StoreController::class, 'transaction'])->name('transaction-store');

    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::get('/transaction-member', [MemberController::class, 'detail'])->name('transaction-member');
    Route::get('/transaction-member-summary', [MemberController::class, 'member-summary'])->name('transaction-member-summary');

    Route::get('/sales-detail', [SalesController::class, 'detail'])->name('sales-detail');
    Route::get('/sales-monthly', [SalesController::class, 'monthly'])->name('sales-monthly');
});