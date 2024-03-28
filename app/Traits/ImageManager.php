<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait ImageManager
{
    public function uploads($file, $path)
    {
        if ($file) {
            $currentTime = now()->toDateTimeString();
            $currentTime = str_replace(':', '-', $currentTime);
            $fileName   = $currentTime . ' ' . $file->getClientOriginalName();
            $path = str_replace(" ", "_", $path);
            $fileName = str_replace(" ", "_", $fileName);
            Storage::putFileAs($path, $file, $fileName);
            return $file = [
                'fileName' => $fileName,
                'fileSize' => $file->getSize(),
            ];
        }
    }
    public function deleteFile($path, $fileName)
    {
        Storage::delete($path . $fileName);
    }
    public function deleteFolder($path)
    {
        Storage::deleteDirectory($path);
    }
}
?>