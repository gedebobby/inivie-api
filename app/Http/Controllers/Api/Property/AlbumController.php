<?php

namespace App\Http\Controllers\Api\Property;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyAlbumRequest;
use App\Repositories\Album\AlbumInterface;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public $album;

    public function __construct(AlbumInterface $album)
    {
        $this->album = $album;
    }

    public function getPropertyAlbum($slug_property){
        return $this->album->getPropertyAlbum($slug_property);
    }

    public function getSpecificPropertyAlbum($slug_property, $id){
        return $this->album->getSpecificPropertyAlbum($slug_property, $id);
    }

    public function addPropertyAlbum(StorePropertyAlbumRequest $request){
        return $this->album->addPropertyAlbum($request);
    }

    public function updatePropertyAlbum(StorePropertyAlbumRequest $request, $album_id){
        return $this->album->updatePropertyAlbum($request, $album_id);
    }

    public function deletePropertyAlbum($album_id){
        return $this->album->deletePropertyAlbum($album_id);
    }

}
