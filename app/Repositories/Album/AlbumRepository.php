<?php

namespace App\Repositories\Album;

use App\Models\AlbumModel;
use App\Models\GalleryAlbumPhotoModel;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumRepository implements AlbumInterface {

    use ApiResponse;

    public function getPropertyAlbum($slug_property){
        $data = AlbumModel::select(['id', 'name'])->whereHas('property', function($query) use($slug_property){
                        $query->where('slug', $slug_property);
                })->get();        
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function getSpecificPropertyAlbum($slug_property, $id){
        $data = GalleryAlbumPhotoModel::where('album_id', $id)
                ->get(['photo_name', 'photo_path']);
        return $this->Success($data, 'Data Retrieved');
    }
    
    public function addPropertyAlbum($request){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $data = AlbumModel::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Added');
    }

    public function updatePropertyAlbum($request, $album_id){
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $data = AlbumModel::where('id', $album_id)->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Updated');
    }

    public function deletePropertyAlbum($album_id){
        DB::beginTransaction();
        try {
            $data = AlbumModel::find($album_id)->with('gallery_photo_album')->first();
            $data->delete();
            if($data) {
                foreach ($data->gallery_photo_album as $photo) {
                    Storage::delete($photo->photo_path);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            DB::rollback();
            return $this->Error($msg, 500);
        }  
        return $this->Success($data, 'Data Deleted');
    }




}