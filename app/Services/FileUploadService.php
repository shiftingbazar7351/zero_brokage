<?php

namespace App\Services;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function uploadImage($filePath, $filename)
    {
        $imageName = time() . '.' . $filename->getClientOriginalExtension();
        // $filename->move(public_path('storage/' . $filePath), $imageName);
         $filename->storeAs('public/'.$filePath, $imageName);
        return $imageName;
    }
    public function removeImage($filepath, $filename)
    {
        if($filename){
            $filePath = storage_path('app/public/' . $filepath . $filename);

            if (file_exists($filePath)) {
                unlink($filePath);

                return true; // File deleted successfully
            }
        }
   
        return  false;
    }
}
