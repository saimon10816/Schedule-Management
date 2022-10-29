<?php


namespace App\Http\Services;


use Illuminate\Support\Facades\Storage;
use Exception;

class FileManagementService extends BaseService
{
    /**
     * @var string
     */
    private $storagePath = "/storage/";
    /**
     * @param $file
     * @param $destinationPath
     * @param null $oldFile
     * @return array
     */
    public function uploadFile ($file, $destinationPath, $oldFile = null): array {
        if ($oldFile != null) {
            $this->deleteFile($destinationPath, $oldFile);
        }
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $fileUploadPath = public_path().$this->storagePath.$destinationPath;
        $uploadFileResponse = $file->move($fileUploadPath, $fileName);
        $fileName = 'storage/'.$destinationPath.$fileName;
//        $fileName = env('SERVER_URL').'storage/'.$destinationPath.$fileName;


        return !$uploadFileResponse ?
            $this->response()->error():
            $this->response($fileName)->success();
    }

    /**
     * @param $destinationPath
     * @param $file
     * @return bool
     */
    public function deleteFile($destinationPath, $file): bool {
        if ($file != null) {
            try {
                $exists =  Storage::disk('public')->exists($destinationPath.$file);

                if (!$exists) {
                    return false;
                }
                Storage::disk('public')->delete($destinationPath.$file);
                return true;
            } catch (Exception $e) {

                return false;
            }
        }
    }


    /**
     * @return string
     */
//    function backgroundImagePath(): string {
//        return 'img/';
//    }

//    function imagePath(): string
//    {
//        return 'messages/images/';
//    }
//
//    public function image()
//    {
//        return 'messages/images/';
//    }
//
//    public function ProjectImagePath()
//    {
//        return 'projects/images/';
//    }
//
//    public function partnerIconPath()
//    {
//        return 'partners/icons/';
//
//    }


}
