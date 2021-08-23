<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\BallController;
use App\Http\Controllers\Admin\Master\FieldController;
use App\Http\Controllers\Admin\Master\PaymentTypeController;
use App\Http\Controllers\Admin\Master\UserController;
use App\Http\Controllers\Admin\Order\IncomeController;
use App\Http\Controllers\Admin\Order\SummaryController;
use App\Http\Controllers\Admin\Order\TransactionController as OrderTransactionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\TransactionController;
use App\Models\PaymentType;
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
Route::patch('app/profile/edit', [ProfileController::class, 'update']);
Route::get('app/profile/password', [ProfileController::class, 'password'])->name('app.profile.password');
Route::patch('app/profile/password', [ProfileController::class, 'updatePassword']);
// Transaction
Route::middleware(['auth'])->group(function () {
    Route::post('order/booking/{field}', [OrderController::class, 'booking'])
        ->middleware('auth')
        ->name('booking');
    Route::get('order/{field}', [OrderController::class, 'order']);
    Route::post('api/check-schedule/{field:id}', [OrderController::class, 'checkSchedule'])->name('check-schedule');
    Route::get('app/profile', [ProfileController::class, 'index'])->name('app.profile');
    Route::get('app/profile/edit', [ProfileController::class, 'edit'])->name('app.profile.edit');
    Route::get('app/profile/password', [ProfileController::class, 'password'])->name('app.profile.password');

    Route::get('transaction', [TransactionController::class, 'index'])->name('app.transaction');
    // Route::get('transaction/history', [TransactionController::class, 'history'])->name('app.transaction.history');
    Route::get('transaction/order/{order}', [TransactionController::class, 'order']);
    Route::post('transaction/pay/{transaction}', [TransactionController::class, 'pay'])->name('app.transaction.pay');
    // Route::get('transaction/repayment/{order}', [TransactionController::class, 'pay']);
    Route::get('transaction/{transaction}', [TransactionController::class, 'detail'])->name('app.transaction.detail');
});


Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', [LoginController::class, 'logout']);
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);
});
Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    // Master
    Route::group(['prefix' => 'master', 'name' => 'master.'], function () {
        // Pengguna Route | customer
        Route::get('users', [UserController::class, 'index'])->name('user.index');
        Route::prefix('user')->group(function () {
            Route::post('/', [UserController::class, 'store'])->name('user.store');
            Route::get('create', [UserController::class, 'create'])->name('user.create');
            Route::patch('update/{user}', [UserController::class, 'update']);
            Route::delete('delete/{user}',[UserController::class,'destroy']);
        });
        // Ball Route | ball
        Route::get('balls', [BallController::class, 'index'])->name('ball.index');
        Route::prefix('ball')->group(function () {
            Route::post('/', [BallController::class, 'store'])->name('ball.store');
            Route::get('create', [BallController::class, 'create'])->name('ball.create');
            Route::get('edit/{ball}', [BallController::class, 'edit']);
            Route::patch('update/{ball}', [BallController::class, 'update']);
            Route::delete('delete/{ball}', [BallController::class, 'destroy']);
        });
        // Lapangan Route | field
        Route::get('fields', [FieldController::class, 'index'])->name('field.index');
        Route::prefix('field')->group(function () {
            Route::post('/', [FieldController::class, 'store'])->name('field.store');
            Route::get('create', [FieldController::class, 'create'])->name('field.create');
            Route::get('edit/{field}', [FieldController::class, 'edit'])->name('field.edit');
            Route::patch('edit/{field}', [FieldController::class, 'update'])->name('field.update');
            Route::delete('delete/{field}', [FieldController::class, 'destroy']);
        });
        // Lapangan Route | paymentType
        Route::get('payment-types', [PaymentTypeController::class, 'index'])->name('paymentType.index');
        Route::prefix('payment-type')->group(function () {
            Route::post('/', [PaymentTypeController::class, 'store'])->name('paymentType.store');
            Route::get('create', [PaymentTypeController::class, 'create'])->name('paymentType.create');
            Route::get('edit/{payment}', [PaymentTypeController::class, 'edit']);
            Route::patch('update/{payment}', [PaymentTypeController::class, 'update']);
            Route::delete('delete/{payment}', [PaymentTypeController::class, 'destroy']);
        });
    });
    // Order
    Route::prefix('order')->group(function () {
        // Rekap Orderan
        Route::get('sumaries', [SummaryController::class, 'index'])->name('summary.index');
        Route::prefix('summary')->group(function () {
            Route::post('/', [SummaryController::class, 'store'])->name('summary.store');
            Route::get('create', [SummaryController::class, 'create'])->name('summary.create');
            Route::get('edit/{order}', [SummaryController::class, 'edit']);
            Route::patch('edit/{order}', [SummaryController::class, 'update']);
            Route::get('{order}', [SummaryController::class, 'show']);
        });

        // Pendapatan
        Route::get('incomes', [IncomeController::class, 'index'])->name('income.index');
        Route::prefix('income')->group(function () {
            Route::post('/', [IncomeController::class, 'store'])->name('income.store');
            Route::get('create', [IncomeController::class, 'create'])->name('income.create');
            Route::get('edit/{income}', [IncomeController::class, 'edit']);
            Route::patch('edit/{income}', [IncomeController::class, 'update']);
        });
    });
    Route::patch('transaction/update/{transaction}',[OrderTransactionController::class,'update'])->name('transaction.update');

    
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
Route::group(['middleware'=>'auth.admin','prefix'=>'api','as'=>'api.'],function(){
    //JSON
    Route::get('json/ball/{ball}',[BallController::class,'json'])->name('json.ball');
    Route::get('json/payment-type/{payment}',[PaymentTypeController::class,'json'])->name('json.payment');
    Route::get('json/transaction/{transaction}',[OrderTransactionController::class,'json'])->name('json.transaction');
    Route::get('json/user/{user}',[UserController::class,'json'])->name('json.user');
    
    // Datatable
    Route::get('datatable/orders',[SummaryController::class,'datatable'])->name('orders');
});