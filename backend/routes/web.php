<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

Route::prefix('image')->group(
    function () {
        Route::get('{file}', [ImageController::class, 'show'])->name('showImage');
        Route::get('thumbnails/{file}', [ImageController::class, 'showThumbnail'])->name('showThumbnail');
    }
);
