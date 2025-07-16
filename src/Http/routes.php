<?php

use Illuminate\Support\Facades\Route;
use Artapamudaid\SecureApiServer\Http\Middleware\ValidateApiKey;

Route::middleware(['api', ValidateApiKey::class])
    ->prefix('secure-api')
    ->group(function () {
        Route::post('/ping', function () {
            return response()->json(['pong' => true]);
        });
    });