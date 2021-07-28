<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\CustomerController;
use App\Http\Controllers\Admin\Master\FieldController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\TransactionController;
use Illuminate\Support\Facades\Auth;
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
    return view('user.auth.login');
})->name('login');

Route::get('register', function () {
    return view('user.auth.register');
})->name('register');

Route::get('detail', function () {
    return view('order.detail');
});
Route::get('order', function ($id = 1) { //id lapangan
    $base64 = request()->schedule;
    $schedule = json_decode(base64_decode($base64));
    if (empty($schedule)) {
        return 'Invalid!';
    }
    return view('order.order', compact('schedule'));
});
Route::post('api/check-schedule', [OrderController::class, 'checkSchedule'])->name('check-schedule');
Route::get('app/profile', function () {
    return 1;
})->name('app.profile');
// My Order
Route::get('transaction', [TransactionController::class, 'index'])->name('app.transaction');
Route::get('transaction/history', [TransactionController::class, 'history'])->name('app.transaction.history');
Route::get('transaction/pay/{id}', [TransactionController::class, 'pay']);
Route::get('transaction/{id}', [TransactionController::class, 'detail']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);
});
Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin', 'name' => 'admin.'], function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    // Master
    Route::group(['prefix' => 'master', 'name' => 'master.'], function () {
        // Pelanggan Route | admin.master.customer
        Route::get('customers', [CustomerController::class, 'index'])->name('admin.customer.index');
        Route::prefix('customer')->group(function () {
            Route::post('/', [CustomerController::class, 'store'])->name('admin.customer.store');
            Route::get('create', [CustomerController::class, 'create'])->name('admin.customer.create');
            Route::get('edit/{customer}', [CustomerController::class, 'edit']);
            Route::patch('edit/{customer}', [CustomerController::class, 'update']);
        });
        // Lapangan Route | admin.master.field
        Route::get('fields', [FieldController::class, 'index'])->name('admin.field.index');
        Route::prefix('field')->group(function () {
            Route::post('/', [FieldController::class, 'store'])->name('admin.field.store');
            Route::get('create', [FieldController::class, 'create'])->name('admin.field.create');
            Route::get('edit/{field}', [FieldController::class, 'edit']);
            Route::patch('edit/{field}', [FieldController::class, 'update']);
        });
    });
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
