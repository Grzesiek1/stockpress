<?php

use App\Http\Controllers\FileManagerController;
use Illuminate\Support\Facades\Route;

Route::resource('file-manager', FileManagerController::class);
