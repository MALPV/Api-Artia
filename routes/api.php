<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StyleItemController;

Route::apiResource('style-items', StyleItemController::class);