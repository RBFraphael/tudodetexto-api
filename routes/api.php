<?php

use App\Http\Controllers\Api\Admin\DirectoriesController;
use App\Http\Controllers\Api\Admin\FilesController;
use App\Http\Controllers\Api\Admin\UsersController;
use App\Http\Controllers\Api\Admin\VipAreasController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Public\FilesController as PublicFilesController;
use App\Http\Controllers\Api\Student\DirectoriesController as StudentDirectoriesController;
use App\Http\Controllers\Api\Student\VipAreasController as StudentVipAreasController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, "login"]);
    Route::post('refresh-token', [AuthController::class, "refreshToken"]);
    Route::get('me', [AuthController::class, "me"]);
    Route::post('logout', [AuthController::class, "logout"]);

    Route::post('password-recovery', [PasswordController::class, "passwordRecovery"]);
    Route::post('password-reset/{token}', [PasswordController::class, "passwordReset"]);
});

Route::prefix('admin')->name('admin.')->middleware(AdminMiddleware::class)->group(function () {
    Route::apiResource('users', UsersController::class);

    Route::apiResource('vip-areas', VipAreasController::class);
    Route::post('vip-areas/{vip_area}/add-user', [VipAreasController::class, "addUser"])->name("vip-areas.add-user");
    Route::post('vip-areas/{vip_area}/remove-user', [VipAreasController::class, "removeUser"])->name("vip-areas.remove-user");

    Route::apiResource('directories', DirectoriesController::class);

    Route::apiResource('files', FilesController::class)->except('update');
});

Route::prefix('student')->name('student.')->middleware(StudentMiddleware::class)->group(function () {
    Route::apiResource("vip-areas", StudentVipAreasController::class)->only(["index", "show"]);

    Route::apiResource("directories", StudentDirectoriesController::class)->only("show");
});

Route::get('files/{file}/view', [PublicFilesController::class, "view"])->name("files.view");
