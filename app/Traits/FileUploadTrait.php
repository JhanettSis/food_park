<?php

namespace App\Traits;  // Corrected namespace to follow Laravel conventions

use Illuminate\Http\Request;

trait FileUploadTrait
{
    /**
     * Upload an image to a specified directory.
     *
     * This method handles image uploads and returns the file path after saving.
     * It can be reused across controllers or services to manage file uploads.
     *
     * @param Request $request The HTTP request containing the file.
     * @param string $inputName The name of the input field for the file.
     * @param string $path The destination path for storing the file (default: /uploads).
     * @return string|null The path to the uploaded file or null if no file was uploaded.
     */
    public function uploadImage(Request $request, string $inputName, string $filePath, string $path = "/uploads"): ?string
    {
        // Check if the request contains a file with the specified input name
        if ($request->hasFile($inputName)) {

            // Retrieve the uploaded file
            $image = $request->file($inputName);

            // Get the file extension (corrected method name)
            $ext = $image->getClientOriginalExtension();

            // Generate a unique file name to avoid conflicts
            $imageName = 'media_' . uniqid() . '.' . $ext;

            // Move the file to the specified path within the public directory
            $image->move(public_path($path.$filePath), $imageName);

            // Return the path to the uploaded file
            return $path.$filePath . '/' . $imageName;
        }

        // Return null if no file was uploaded
        return null;
    }
}
