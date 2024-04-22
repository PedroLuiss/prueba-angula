<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;
use App\Http\Controllers\Api\V2\Auth\LoginController;
use App\Http\Controllers\Api\V2\Auth\LogoutController;
use App\Http\Controllers\Api\V2\Auth\RegisterController;
use App\Http\Controllers\Api\V2\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V2\Auth\ResetPasswordController;
use App\Http\Controllers\EmployeeController;

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

Route::prefix('v2')->middleware('json.api')->group(function () {
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/logout', LogoutController::class)->middleware('auth:api');
    Route::post('/register', RegisterController::class);
    Route::post('/password-forgot', ForgotPasswordController::class);
    Route::post('/password-reset', ResetPasswordController::class)->name('password.reset');

});


Route::middleware(['auth:api','json.api'])->group(function () {
    /**----------------------------------------------------Employee---------------------------------------------------- */
    Route::get('/employee/list', [EmployeeController::class, 'list_employee'])->name('employee.listemployee');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.editemployee');
    Route::delete('/employee/delet/{id}', [EmployeeController::class, 'delete_employee'])->name('employee.deletemployee');
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    /**----------------------------------------------------Employee---------------------------------------------------- */
});


