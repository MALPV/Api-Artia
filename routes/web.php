<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'Api-Artia funcionando correctamente 2025' 
    ]);
});