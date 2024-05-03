<?php

namespace App\Http\Controllers;

use App\Models\File;

class ImageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $filePath = storage_path() . File::STORAGE_IMAGES_PATH . $file->hash;

        return response()->file($filePath);
    }

    /**
     * Display the specified resource.
     */
    public function showThumbnail(File $file)
    {
        $filePath = storage_path() . File::STORAGE_IMAGES_THUMBNAILS_PATH . $file->hash;

        return response()->file($filePath);
    }
}
