<?php

namespace App\Repositories\Photos;

use App\Models\AlbumModel;
use App\Models\GalleryAlbumPhotoModel;
use App\Traits\ApiResponse;
use App\Traits\FileUpload;
use Illuminate\Support\Arr;

class PhotoRepository implements PhotoInterface {
    use ApiResponse, FileUpload;
    public function getPropertyPhotos($slug_property){
        $data = GalleryAlbumPhotoModel::
        select(['gallery_album_photo.id', 'gallery_album_photo.photo_name', 'gallery_album_photo.photo_path', 'albums.name'])->
                    join('albums', 'gallery_album_photo.album_id', '=', 'albums.id')
                    ->whereHas('album', function($query) use($slug_property){
                        $query->whereHas('property', function($query) use($slug_property){
                            $query->where('slug', $slug_property);
                        });
                })->get();

        // $data = GalleryAlbumPhotoModel::
        //         join('albums', 'gallery_album_photo.album_id', '=', 'albums.id')
        //         ->join('list_properties', 'albums.list_property_id', '=', 'list_properties.id')
        //         ->where('list_properties.slug', $slug_property)
        //         ->get();
        return $this->Success($data, 'Data Rwetrieved');
    }

    public function addPropertyPhotos($request, $album_id)
    {
        if ($request->hasfile('images')) {
            $album = AlbumModel::with('property')->where('id', $album_id)->first();
            $files = $request->file('images');
            $allowedExt = ['jpg', 'png', 'jpeg', 'webp'];
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();
                $check = in_array($ext, $allowedExt);
                if ($check) {
                    $filename = substr(sha1(rand()), 0, 25) . '.' . $ext;
                    $path = $this->UploadPhoto($file, $filename, $album->property->slug);
                    $photo = new GalleryAlbumPhotoModel();
                    $photo->photo_name = $filename;
                    $photo->photo_path = $path;
                    $photo->album_id = $album_id;
                    $photo->save();
                } else {
                    return $this->Error('File must be image', 422);
                }
            }
            return $this->Success($photo, 'Data Saved');
        } else {
            return $this->Error('No Image', 422);
        }
    }
}