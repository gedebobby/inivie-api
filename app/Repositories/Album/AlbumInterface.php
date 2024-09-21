<?php

namespace App\Repositories\Album;

interface AlbumInterface {
    public function getPropertyAlbum($slug_property);
    public function getSpecificPropertyAlbum($slug_property, $id);
    public function addPropertyAlbum($request);
    public function updatePropertyAlbum($request, $album_id);
    public function deletePropertyAlbum($album_id);
}