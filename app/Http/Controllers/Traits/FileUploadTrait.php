<?php
namespace App\Http\Controllers\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    public function uploadImage($file, $path)
    {
        // $extension = $file->getClientOriginalExtension();
        // $sha = sha1($file->getClientOriginalName());
        // $filename = date('Y-m-d-h-i-s')."-".$sha.".".$extension;

        if (!is_dir($path)) {
            mkdir(storage_path($path), 0777, true);
        }
        // $file->move($path, $filename);
        $filename = Storage::disk('local')->put('public/'.$path, $file);
        // $filename = str_ireplace($path."/", "", $filename);
        return $filename;
        // return $path.$filename;
    }
}


