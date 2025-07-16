<?php

use Illuminate\Support\Facades\Route;
use Artapamudaid\SecureApiServer\Http\Controllers\ApiKeyController;

Route::prefix('secure-api')->group(function () {
    Route::post('/key', [ApiKeyController::class, 'generate']);
    Route::get('/keys', [ApiKeyController::class, 'index']);
    Route::delete('/key/{id}', [ApiKeyController::class, 'destroy']);
    Route::patch('/key/{id}/revoke', [ApiKeyController::class, 'revoke']);

    // Example secured ping endpoint
    Route::middleware('secure-api')->post('/ping', function () {
        return response()->json(['message' => 'pong']);
    });
});
