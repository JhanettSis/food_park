<?php

namespace App\Traits;  // Corrected namespace to follow Laravel conventions

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

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
    public function uploadImage(Request $request, string $inputName, string $filePath, string $oldPath = NULL, string $path = "/uploads")
    {
        // Check if the request contains a file with the specified input name
        if ($request->hasFile($inputName)) {

            // Retrieve the uploaded file
            $image = $request->file($inputName);

            // Get the file extension (corrected method name)
            $ext = $image->getClientOriginalExtension();

            // Generate a unique file name to avoid conflicts
            $imageName = 'media_' . uniqid() . '.' . $ext;

            // Check if the image is valid and has been uploaded correctly
            if ($image->isValid()) {
                // Move the file to the specified path within the public directory
                $image->move(public_path($path . $filePath), $imageName);

                // If there’s an old image, delete it
                if ($oldPath && File::exists(public_path($oldPath))) {
                    File::delete(public_path($oldPath));
                }

                // Return the path to the uploaded file
                return $path . $filePath . '/' . $imageName;
            } else {
                // Handle invalid file case
                return null;  // Return null or handle error appropriately
            }
        }

        return null;  // If no file is uploaded, return null
    }
    /**
     * Remove file
     *  */
    function removeImage(string $path): void
    {
        // delete file or old image  from uploads folder if exist
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
