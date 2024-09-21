<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhotoRequest;
use App\Models\PhotoModel;
use App\Repositories\Photos\PhotoInterface;
use App\Traits\FileUpload;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    use FileUpload;
    public $photo;

    public function __construct(PhotoInterface $photo)
    {
        $this->photo = $photo;   
    }

    public function getPropertyPhotos($slug_property){
        return $this->photo->getPropertyPhotos($slug_property);
    }

    public function addPropertyPhotos(Request $request, $album_id){
        return $this->photo->addPropertyPhotos($request, $album_id);
    }
}