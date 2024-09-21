<?php

namespace App\Repositories\Photos;

interface PhotoInterface {
    public function getPropertyPhotos($slug_property);
    public function addPropertyPhotos($request, $album_id);
    
}