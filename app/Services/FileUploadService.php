<?php

namespace App\Services;

// use Dotenv\Util\Str;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class FileUploadService
{

    public static function upload(string $data, string $filename, string $folder_path): array
    {

        $fileName = md5(microtime()) . $filename;

        $filePath = "public/$folder_path/{$fileName}";
        $upload = Storage::put($filePath, $data);

        return ['success' => $upload, 'path' => $filePath];

    }

    public static function get_file(Request $request)
    {
        $path = $request['path'] ?? 'public/null_image.png';
        return response()->file(Storage::path($path));
    }
    


}
