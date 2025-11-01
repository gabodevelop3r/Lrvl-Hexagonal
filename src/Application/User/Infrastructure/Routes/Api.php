<?php

use Illuminate\Support\Facades\Route;
use Src\Application\User\Infrastructure\Controllers\GetUserController;

Route::get('/{userId}', GetUserController::class);
