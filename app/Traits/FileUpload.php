<?php 

namespace App\Traits;

trait FileUpload {
    
    protected function UploadPhoto($file, $filename, $folderpath){
        $path = $file->storeAs($folderpath, $filename);
        return $path;
    }

    protected function UploadIcon($file, $filename, $icon_type){
        if ($icon_type == 'facility') {
            $folder = 'FacilityRoomIcon';
        } elseif ($icon_type == 'service') {
            $folder = 'ServicePropertyIcon';
        }
        $path_folder = 'inivie_page/' . $folder;            
        $path = $file->storeAs($path_folder, $filename);   
        return $path;
    }
    
}
