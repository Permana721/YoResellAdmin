<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', [UserController::class, 'register']);
});
Route::post('/regpros', [UserController::class, 'regpros'])->name('regpros');
Route::post('/logpros', [UserController::class, 'logpros'])->name('logpros');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['login'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::fallback(function () {
        return back();
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
        Route::get('/role', [MenuController::class, 'role'])->name('role');
        Route::get('/role-menu', [MenuController::class, 'roleMenu'])->name('role-menu');

        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('deleteUser');
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/create', [UserController::class, 'create'])->name('create.user');
        Route::post('/user/create/addDataUser', [UserController::class, 'addDataUser'])->name('addDataUser');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('editUser');
        Route::put('/user/{id}/update', [UserController::class, 'update'])->name('updateDataUser');
        
        Route::get('get-users', [UserController::class, 'getUsers'])->name('users.getUsers');
        Route::get('/store', [StoreController::class, 'store'])->name('store');
        Route::get('/region', [StoreController::class, 'region'])->name('region');
        Route::get('/region-store', [StoreController::class, 'regionStore'])->name('region-store');
        Route::get('/report-registrasi', [StoreController::class, 'reportRegistrasi'])->name('report-registrasi');
    });

    Route::get('/transaction-store', [StoreController::class, 'transaction'])->name('transaction-store');
    Route::get('/catalog', [StoreController::class, 'index'])->name('catalog');

    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::get('/member/create', [MemberController::class, 'create'])->name('create.member');
    Route::get('getMember', [MemberController::class, 'getMember'])->name('member.getMember');
    Route::get('/transaction-member', [MemberController::class, 'detail'])->name('transaction-member');
    Route::get('/transaction-member-summary', [MemberController::class, 'summary'])->name('transaction-member-summary');

    Route::get('/sales-detail', [SalesController::class, 'detail'])->name('sales-detail');
    Route::get('/sales-monthly', [SalesController::class, 'monthly'])->name('sales-monthly');
});