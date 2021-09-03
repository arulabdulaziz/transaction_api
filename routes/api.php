<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
// use Illuminate\Routing\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", [UserController::class, "login"])->name('login');
Route::post("/register", [UserController::class, "register"]);
Route::group(
    ['middleware' => ['auth:api']],
    function () {
        Route::post("/logout", [UserController::class, "logout"]);
        Route::resource("/transaction", TransactionController::class);
    }
);
Route::post("/admin/login", [AdminController::class, "login"])->name('adminLogin');
Route::group(['middleware' => ['auth:admin']], function () {
    Route::post("admin/logout", [AdminController::class, "logout"]);
});
