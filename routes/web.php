<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\FieldController;
use App\Http\Controllers\HomeController;
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
    return view('auth.login');
})->name('login');

Route::get('register', function () {
    return view('auth.register');
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

Auth::routes();

Route::get('admin', [DashboardController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'name' => 'admin.'], function () {
    Route::group(['prefix' => 'master', 'name' => 'master.'], function () {
        // Lapangan Route | admin.master.field
        Route::get('fields', [FieldController::class, 'index'])->name('admin.master.field.index');
        Route::prefix('field')->group(function () {
            Route::post('/', [FieldController::class, 'store'])->name('admin.field.store');
            Route::get('create', [FieldController::class, 'create'])->name('admin.field.create');
            Route::get('edit/{field}', [FieldController::class, 'edit']);
            Route::patch('edit/{field}', [FieldController::class, 'update']);
        });
    });
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});
