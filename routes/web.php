<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\BallController;
use App\Http\Controllers\Admin\Master\FieldController;
use App\Http\Controllers\Admin\Master\UserController;
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
        // Pengguna Route | admin.customer
        Route::get('users', [UserController::class, 'index'])->name('admin.user.index');
        Route::prefix('user')->group(function () {
            Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
            Route::get('edit/{user}', [UserController::class, 'edit']);
            Route::patch('edit/{user}', [UserController::class, 'update']);
        });
        // Lapangan Route | admin.field
        Route::get('fields', [FieldController::class, 'index'])->name('admin.field.index');
        Route::prefix('field')->group(function () {
            Route::post('/', [FieldController::class, 'store'])->name('admin.field.store');
            Route::get('create', [FieldController::class, 'create'])->name('admin.field.create');
            Route::get('edit/{field}', [FieldController::class, 'edit']);
            Route::patch('edit/{field}', [FieldController::class, 'update']);
        });
        // Lapangan Route | admin.ball
        Route::get('balls', [BallController::class, 'index'])->name('admin.ball.index');
        Route::prefix('ball')->group(function () {
            Route::post('/', [BallController::class, 'store'])->name('admin.ball.store');
            Route::get('create', [BallController::class, 'create'])->name('admin.ball.create');
            Route::get('edit/{ball}', [BallController::class, 'edit']);
            Route::patch('edit/{ball}', [BallController::class, 'update']);
        });
    });
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
