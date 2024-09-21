<?php

namespace App\Repositories\Gallery;

use App\Models\GalleryAlbumPhotoModel;
use App\Models\GalleryModel;
use App\Traits\ApiResponse;

class GalleryRepository implements GalleryInterface {
    use ApiResponse;

    public function getPropertyGallery($slug_property){
        // get gallery by property
        // $data = GalleryModel::with(['album' => function($q) use($slug_property){
        //             $q->with('gallery_photo_album');
        //         }])->get();

        // get all photo by property
        $data = GalleryAlbumPhotoModel::whereHas('album', function($q) use($slug_property){
                    $q->whereHas('gallery', function($q) use($slug_property){
                        $q->whereHas('property', function($q) use($slug_property){
                            $q->where('slug', $slug_property);
                        });
                    });
                })->get(['photo_name', 'photo_path']);
        return $this->Success($data, 'Data Retrieved');
    }    
}