<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AwsController extends Controller
{
    public static function fileDelete($path)
    {
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
        }
    }

    public static function fileUpload($files, $folder, $is_array=true)
    {
        try {
            $urls = [];
            foreach ($files as $file) {
                $filename = $file->getClientOriginalName();
                $full_name = str_replace(' ', '', time() . "-" . $filename);
                $bucket = "https://s3.sa-east-1.amazonaws.com/storage-adminsystem.com.br/{$folder}/";
                $url = $bucket . $full_name;

                $urls[] = str_replace(' ', '', $url);
                Storage::disk('s3')->putFileAs($folder . '/', $file, $full_name);
            }
            if (!$is_array){
                return $urls[0];
            }
            return $urls;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
