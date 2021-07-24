<?php

use App\Http\Controllers\User\OrderController;
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

Route::get('/', function () {
    return view('dashboard');
})->name('app');
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
})->name('register');

Route::get('detail', function () {
    return view('detail');
});
Route::get('order', function ($id = 1) { //id lapangan
    $base64 = request()->schedule;
    $schedule = json_decode(base64_decode($base64));
    if (empty($schedule)) {
        return 'Invalid!';
    }
    return view('order', compact('schedule'));
});
Route::post('api/check-schedule', [OrderController::class, 'checkSchedule'])->name('check-schedule');

// My Order
Route::get('transaction', [OrderController::class, 'transaction'])->name('app.transaction');
Route::get('transaction/history', [OrderController::class, 'transactionHistory'])->name('app.transaction.history');
