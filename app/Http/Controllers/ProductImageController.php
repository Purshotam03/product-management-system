<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function show($filename)
    {
        $path = storage_path('app/product_images/' . $filename);

        if (!Storage::exists('product_images/' . $filename) || !file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
