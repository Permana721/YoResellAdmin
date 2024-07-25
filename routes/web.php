<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
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

Route::middleware(['login'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::fallback(function () {
        return redirect('/home');
    });

    Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
    Route::get('/role', [MenuController::class, 'role'])->name('role');
    Route::get('/role-menu', [MenuController::class, 'roleMenu'])->name('role-menu');

    Route::get('/user', [HomeController::class, 'user'])->name('user');

    Route::get('/store', [StoreController::class, 'store'])->name('store');
    Route::get('/region', [StoreController::class, 'region'])->name('region');
    Route::get('/catalog', [StoreController::class, 'index'])->name('catalog');
    Route::get('/region-store', [StoreController::class, 'regionStore'])->name('region-store');
    Route::get('/transaction-store', [StoreController::class, 'transaction'])->name('transaction-store');
    Route::get('/report-registrasi', [StoreController::class, 'reportRegistrasi'])->name('report-registrasi');

    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::get('/transaction-member', [MemberController::class, 'detail'])->name('transaction-member');
    Route::get('/transaction-member-summary', [MemberController::class, 'summary'])->name('transaction-member-summary');

    Route::get('/sales-detail', [SalesController::class, 'detail'])->name('sales-detail');
    Route::get('/sales-monthly', [SalesController::class, 'monthly'])->name('sales-monthly');
});
