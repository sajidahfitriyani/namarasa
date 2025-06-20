<?php

use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return [
        'APP_BASE_PATH' => $_ENV['APP_BASE_PATH'] ?? null,
        'dirname(__DIR__)' => dirname(__DIR__)
    ];
});
