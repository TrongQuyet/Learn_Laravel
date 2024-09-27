<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Modules\Web\Http\Controllers\AuthController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware(['auth:api','verified', 'role:admin|editor', 'throttle:60,1'])->group( function () {
    Route::get('contracts', function () {
        return App\Models\Contract::withoutGlobalScopes()->get();
    });
    Route::get('user', [AuthController::class, 'user']);
    Route::get('users', [AuthController::class, 'users']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('contract/create', function () {
        \Log::info("contract created");
    })->middleware('permission:create contracts');
    Route::get('contract/update', function () {
        \Log::info("contract updated");
    })->middleware('permission:update contracts');
    Route::get('contract/delete', function () {
        \Log::info("contract deleted");
    })->middleware('permission:delete contracts');
});
Route::get('login/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
