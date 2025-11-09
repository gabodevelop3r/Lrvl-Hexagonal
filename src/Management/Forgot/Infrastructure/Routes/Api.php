<?php

// namespace Src\Management\Forgot\Infrastructure\Routes;
use Illuminate\Support\Facades\Route;
use Src\Management\Forgot\Infrastructure\Controllers\ForgotUserForgotPasswordController;

Route::post('', ForgotUserForgotPasswordController::class);
