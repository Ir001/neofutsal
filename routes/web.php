<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\BallController;
use App\Http\Controllers\Admin\Master\FieldController;
use App\Http\Controllers\Admin\Master\PaymentTypeController;
use App\Http\Controllers\Admin\Master\UserController;
use App\Http\Controllers\Admin\Order\IncomeController;
use App\Http\Controllers\Admin\Order\SummaryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
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

Route::get('/', [UserDashboardController::class, 'index'])->name('app');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authLogin'])->name('login');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'authRegister']);

Route::get('detail/{field}', [OrderController::class, 'detail']);
Route::post('order/booking/{field}', [OrderController::class, 'booking'])
    ->middleware('auth')
    ->name('booking');
Route::get('order/{field}', [OrderController::class, 'order']);
Route::post('api/check-schedule/{field:id}', [OrderController::class, 'checkSchedule'])->name('check-schedule');
Route::get('app/profile', [ProfileController::class, 'index'])->name('app.profile');
Route::get('app/profile/edit', [ProfileController::class, 'edit'])->name('app.profile.edit');
Route::get('app/profile/password', [ProfileController::class, 'password'])->name('app.profile.password');
// My Order
Route::get('transaction', [TransactionController::class, 'index'])->name('app.transaction');
Route::get('transaction/history', [TransactionController::class, 'history'])->name('app.transaction.history');
Route::get('transaction/pay/{id}', [TransactionController::class, 'pay']);
Route::get('transaction/{id}', [TransactionController::class, 'detail']);

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', [LoginController::class, 'logout']);
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
        // Lapangan Route | admin.ball
        Route::get('balls', [BallController::class, 'index'])->name('admin.ball.index');
        Route::prefix('ball')->group(function () {
            Route::post('/', [BallController::class, 'store'])->name('admin.ball.store');
            Route::get('create', [BallController::class, 'create'])->name('admin.ball.create');
            Route::get('edit/{ball}', [BallController::class, 'edit']);
            Route::patch('edit/{ball}', [BallController::class, 'update']);
        });
        // Lapangan Route | admin.field
        Route::get('fields', [FieldController::class, 'index'])->name('admin.field.index');
        Route::prefix('field')->group(function () {
            Route::post('/', [FieldController::class, 'store'])->name('admin.field.store');
            Route::get('create', [FieldController::class, 'create'])->name('admin.field.create');
            Route::get('edit/{field}', [FieldController::class, 'edit']);
            Route::patch('edit/{field}', [FieldController::class, 'update']);
        });
        // Lapangan Route | admin.paymentType
        Route::get('payment-types', [PaymentTypeController::class, 'index'])->name('admin.paymentType.index');
        Route::prefix('payment-type')->group(function () {
            Route::post('/', [PaymentTypeController::class, 'store'])->name('admin.paymentType.store');
            Route::get('create', [PaymentTypeController::class, 'create'])->name('admin.paymentType.create');
            Route::get('edit/{paymentType}', [PaymentTypeController::class, 'edit']);
            Route::patch('edit/{paymentType}', [PaymentTypeController::class, 'update']);
        });
    });
    // Order
    Route::prefix('order')->group(function () {
        // Rekap Orderan
        Route::get('sumaries', [SummaryController::class, 'index'])->name('admin.summary.index');
        Route::prefix('summary')->group(function () {
            Route::post('/', [SummaryController::class, 'store'])->name('admin.summary.store');
            Route::get('create', [SummaryController::class, 'create'])->name('admin.summary.create');
            Route::get('edit/{summary}', [SummaryController::class, 'edit']);
            Route::patch('edit/{summary}', [SummaryController::class, 'update']);
        });
        // Pendapatan
        Route::get('incomes', [IncomeController::class, 'index'])->name('admin.income.index');
        Route::prefix('income')->group(function () {
            Route::post('/', [IncomeController::class, 'store'])->name('admin.income.store');
            Route::get('create', [IncomeController::class, 'create'])->name('admin.income.create');
            Route::get('edit/{income}', [IncomeController::class, 'edit']);
            Route::patch('edit/{income}', [IncomeController::class, 'update']);
        });
    });
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
